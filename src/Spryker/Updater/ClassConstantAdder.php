<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Updater;

use Spryker\AbstractUpdater;
use Symfony\Component\Finder\SplFileInfo;

class ClassConstantAdder extends AbstractUpdater
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
        foreach ($this->configuration as $fileNamePattern => $constants) {
            foreach ($constants as $constant) {
                $content = $this->addConstantToFile($constant, $content);
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
        foreach ($this->configuration as $fileNamePattern => $constants) {
            if (strpos($fileInfo->getPathname(), $fileNamePattern) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $constant
     * @param string $content
     *
     * @return string
     */
    protected function addConstantToFile($constant, $content)
    {
        if (preg_match('/' . preg_quote($constant, '/') . '/', $content)) {
            return $content;
        }

        $stringToAdd = '{' . PHP_EOL . PHP_EOL . '    ' . $constant;

        $content = preg_replace('/^\{/m', $stringToAdd, $content);

        return $content;
    }

}
