<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Updater;

use Spryker\AbstractUpdater;
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
class DuplicateConfigConstant extends AbstractUpdater
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
            foreach ($newConstants as $newConstant) {
                if (preg_match('/(?!\s$config[' . $oldConstant . '])/', $content) && !preg_match('/' . $newConstant . '/', $content)) {
                    $this->outputMessage(sprintf(self::MESSAGE_TEMPLATE_INFO, $oldConstant, $fileInfo->getFilename()));
                    if ($this->askIfBundleIsUsed($newConstant)) {
                        $content = $this->addMissingConfig($oldConstant, $newConstant, $content);
                        $content = $this->addMissingUseStatement($oldConstant, $newConstant, $content);
                    }
                }
            }
        }

        return $content;
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
     *
     * @return bool
     */
    protected function askIfBundleIsUsed($newConstant)
    {
        $bundleName = preg_replace('/Constants\:\:(.*)/', '', $newConstant);

        return $this->askQuestion('Are you using the "<fg=green>' . $bundleName . '</>" Bundle?');
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
        $search = sprintf('$config[%s]', $oldConstant);
        $replace = sprintf('%s' . PHP_EOL . '    = $config[%s]', $search, $newConstant);

        $content = str_replace($search, $replace, $content);
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
