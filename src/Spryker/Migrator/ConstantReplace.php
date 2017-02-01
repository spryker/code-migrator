<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Migrator;

use Spryker\AbstractMigrator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

/**
 * Specification:
 * - Replaces one constant with another.
 * - Adds use statement of new constant after the old constants use statement.
 * - Automatically detects if NewBundleConstants exists in project and add this one.
 * - If NewBundleConstants does not exists in project it adds the one from core.
 *
 * Configuration can be like this:
 * ```
 * $configuration = [
 *      'OldBundleConstants::CONSTANT_NAME_A' => 'NewBundleConstants::CONSTANT_NAME_A',
 * ];
 * ```
 */
class ConstantReplace extends AbstractMigrator
{

    const MESSAGE_TEMPLATE_REPLACED_CONSTANT = 'Replaced "<fg=green>%s</>" with "<fg=green>%s</>"';
    const MESSAGE_TEMPLATE_ADDED_USE = 'Added new use statement "<fg=green>use %s;</>" after "<fg=green>use %s;</>"';

    /**
     * @var string
     */
    protected $addUseAfter;

    /**
     * @var string
     */
    protected $newUse;

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return string
     */
    public function execute(SplFileInfo $fileInfo, $content)
    {
        foreach ($this->configuration as $search => $replace) {
            if (preg_match('/' . $search . '/', $content)) {
                $oldProjectUse = $this->buildConstantsClassName($search);
                if (strpos($content, 'use ' . $oldProjectUse . ';') !== false) {
                    $addUseAfter = $oldProjectUse;
                } else {
                    $oldSprykerUse = $this->buildConstantsClassName($search, false);
                    $addUseAfter = $oldSprykerUse;
                }

                $constantsClassName = $this->buildConstantsClassName($replace);

                if ($this->existsNewConstantClassInProject($constantsClassName)) {
                    $newUse = $constantsClassName;
                } else {
                    $newUse = $this->buildConstantsClassName($replace, false);
                }

                $content = str_replace($search, $replace, $content);
                $this->outputConstantReplacedMessage($search, $replace);

                $content = $this->addUseStatement($newUse, $addUseAfter, $content);
            }
        }

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
        $this->outputAddedUseStatementMessage($newUse, $addUseAfter);

        return $content;
    }

    /**
     * @param string $search
     * @param string $replace
     *
     * @return void
     */
    protected function outputConstantReplacedMessage($search, $replace)
    {
        $message = sprintf(
            static::MESSAGE_TEMPLATE_REPLACED_CONSTANT,
            $search,
            $replace
        );

        $this->outputMessage($message);
    }

    /**
     * @param string $newUse
     * @param string $addUseAfter
     *
     * @return void
     */
    protected function outputAddedUseStatementMessage($newUse, $addUseAfter)
    {
        $message = sprintf(
            static::MESSAGE_TEMPLATE_ADDED_USE,
            $newUse,
            $addUseAfter
        );

        $this->outputMessage($message);
    }

}
