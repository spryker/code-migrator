<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Migrator;

use Spryker\AbstractMigrator;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Specification:
 * - Searches for the need to apply "duplicate constant pattern".
 * - Searches by default only in config_* files.
 * - DuplicatedConstants defines the bundle constants to use for.
 * - NewConstants defines which bundle constants needs to be added.
 *
 * Configuration can be like this:
 * ```
 * $configuration = [
 *      'DuplicatedConstants' => 'NewConstants',
 * ];
 * ```
 */
class DuplicateConfigConstant extends AbstractMigrator
{

    const MESSAGE_TEMPLATE_ADDED_USE = 'Added new use statement "<fg=green>use %s;</>" after "<fg=green>use %s;</>"';
    const MESSAGE_TEMPLATE_ADDED_CONFIG = 'Added "<fg=green>$config[%s]</>" after "<fg=green>$config[%s]</>"';
    const MESSAGE_TEMPLATE_INFO = 'Found "<fg=green>%s</>" in "<fg=green>%s</>"' . PHP_EOL . 'If you use the following bundle then i can update the mentioned file';

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return string
     */
    public function execute(SplFileInfo $fileInfo, $content)
    {
        foreach ($this->configuration as $oldConstant => $newConstants) {
            $searchConfig = preg_quote($this->buildConfig($oldConstant), '/');
            $searchPatternConstantToDuplicate = '/^' . $searchConfig . '/m';
            if (!preg_match($searchPatternConstantToDuplicate, $content)) {
                continue;
            }

            foreach ($newConstants as $newConstant) {
                $addConfig = $this->buildConfigToAdd($newConstant);
                $addConfigPattern = '/' . preg_quote($addConfig, '/') . '/';
                if (!preg_match($addConfigPattern, $content)) {
                    $additionalMessage = sprintf(self::MESSAGE_TEMPLATE_INFO, $oldConstant, $fileInfo->getFilename());
                    if ($this->askIfBundleIsUsed($newConstant, $additionalMessage)) {
                        $content = $this->addMissingConfig($oldConstant, $newConstant, $content);
                        $content = $this->addMissingUseStatement($oldConstant, $newConstant, $content);
                    }
                }
            }
        }

        return $content;
    }

    /**
     * @param string $constant
     *
     * @return string
     */
    protected function buildConfig($constant)
    {
        return sprintf('$config[%s]', $constant);
    }

    /**
     * @param string $constant
     *
     * @return string
     */
    protected function buildConfigToAdd($constant)
    {
        return sprintf('    = %s', $this->buildConfig($constant));
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return bool
     */
    public function accept(SplFileInfo $fileInfo)
    {
        if (preg_match('/config\/Shared\/config_/', $fileInfo->getPathname())) {
            return true;
        }

        return false;
    }

    /**
     * @param string $newConstant
     * @param string $additionalMessage
     *
     * @return bool
     */
    protected function askIfBundleIsUsed($newConstant, $additionalMessage)
    {
        $bundleName = preg_replace('/Constants\:\:(.*)/', '', $newConstant);
        $question = 'Are you using the "<fg=green>' . $bundleName . '</>" Bundle?';

        return $this->askQuestion($additionalMessage . PHP_EOL . $question);
    }

    /**
     * @param string $oldConstant
     * @param string $newConstant
     * @param string $content
     *
     * @return string
     */
    protected function addMissingConfig($oldConstant, $newConstant, $content)
    {
        $searchConfig = preg_quote($this->buildConfig($oldConstant), '/');
        $searchPatternConstantToDuplicate = '/^' . $searchConfig . '/m';

        $addConfig = $this->buildConfigToAdd($newConstant);

        $replace = sprintf('%s' . PHP_EOL . '%s', $this->buildConfig($oldConstant), $addConfig);

        $content = preg_replace($searchPatternConstantToDuplicate, $replace, $content);

        $this->outputMessage(sprintf(static::MESSAGE_TEMPLATE_ADDED_CONFIG, $newConstant, $oldConstant));

        return $content;
    }

    /**
     * @param string $oldConstant
     * @param string $newConstant
     * @param string $content
     *
     * @return string
     */
    protected function addMissingUseStatement($oldConstant, $newConstant, $content)
    {
        $oldProjectUse = $this->buildConstantsClassName($oldConstant);
        if (strpos($content, 'use ' . $oldProjectUse . ';') !== false) {
            $addUseAfter = $oldProjectUse;
        } else {
            $oldSprykerUse = $this->buildConstantsClassName($oldConstant, false);
            $addUseAfter = $oldSprykerUse;
        }

        $constantsClassName = $this->buildConstantsClassName($newConstant);

        if ($this->existsNewConstantClassInProject($constantsClassName)) {
            $newUse = $constantsClassName;
        } else {
            $newUse = $this->buildConstantsClassName($newConstant, false);
        }

        $content = $this->addUseStatement($newUse, $addUseAfter, $content);

        return $content;
    }

    /**
     * @param string $newUse
     * @param string $addUseAfter
     * @param string $content
     *
     * @return string
     */
    protected function addUseStatement($newUse, $addUseAfter, $content)
    {
        if (preg_match('/use ' . preg_quote($newUse, '/') . ';/', $content)) {
            return $content;
        }
        $search = 'use ' . $addUseAfter . ';';
        $replace = $search . PHP_EOL . 'use ' . $newUse . ';';

        $content = str_replace($search, $replace, $content);

        $message = sprintf(static::MESSAGE_TEMPLATE_ADDED_USE, $newUse, $addUseAfter);
        $this->outputMessage($message);

        return $content;
    }

    /**
     * @param string $constantString
     * @param bool $useProjectNamespace
     *
     * @return string
     */
    protected function buildConstantsClassName($constantString, $useProjectNamespace = true)
    {
        list($constantsClassName, $constantName) = explode('::', $constantString);
        $bundleName = str_replace('Constants', '', $constantsClassName);

        $namespace = ($useProjectNamespace) ? PROJECT_NAMESPACE : 'Spryker';

        return sprintf('%s\\Shared\\%s\\%s', $namespace, $bundleName, $constantsClassName);
    }

    /**
     * @param string $constantClassName
     *
     * @return bool
     */
    protected function existsNewConstantClassInProject($constantClassName)
    {
        return interface_exists($constantClassName);
    }

}
