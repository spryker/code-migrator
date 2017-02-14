<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Migrator;

use Spryker\AbstractMigrator;
use Symfony\Component\Finder\SplFileInfo;

class ClassMethodAdder extends AbstractMigrator
{

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @param $configuration
     */
    public function __construct($configuration)
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
        foreach ($this->configuration as $fileNamePattern => $methods) {
            if (strpos($fileInfo->getPathname(), $fileNamePattern) === false) {
                continue;
            }
            foreach ($methods as $search => $method) {
                $content = $this->addMethodToFile($search, $method, $content);
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
        foreach ($this->configuration as $fileNamePattern => $methods) {
            if (strpos($fileInfo->getPathname(), $fileNamePattern) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $search
     * @param string $method
     * @param string $content
     *
     * @return string
     */
    protected function addMethodToFile($search, $method, $content)
    {
        if (preg_match('/' . preg_quote($search, '/') . '/', $content)) {
            return $content;
        }

        $stringToAdd = $method . PHP_EOL . PHP_EOL . '}';

        $content = preg_replace('/^\}/m', $stringToAdd, $content);

        return $content;
    }

}
