<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Updater;

use Spryker\AbstractUpdater;
use Symfony\Component\Finder\SplFileInfo;

class ConstantsReplace extends AbstractUpdater
{

    /**
     * @var array
     */
    protected $searchAndReplace;

    /**
     * @var string
     */
    protected $addUseAfter;

    /**
     * @var string
     */
    protected $newUse;

    /**
     * @param array $searchAndReplace
     */
    public function __construct(array $searchAndReplace)
    {
        $this->searchAndReplace = $searchAndReplace;

        if (!defined('PROJECT_NAMESPACE')) {
            define('PROJECT_NAMESPACE', 'Pyz');
        }
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfoInfo
     * @param string $content
     *
     * @return string
     */
    public function execute(SplFileInfo $fileInfoInfo, $content)
    {
        foreach ($this->searchAndReplace as $search => $replace) {
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
        $search = 'use ' . $addUseAfter . ';';
        $replace = $search . PHP_EOL . 'use ' . $newUse . ';';

        return str_replace($search, $replace, $content);
    }

}
