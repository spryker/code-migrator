<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Updater;

use PHPUnit_Framework_TestCase;
use Spryker\UpdaterInterface;
use Symfony\Component\Finder\SplFileInfo;

abstract class AbstractUpdaterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @param string $fileName
     *
     * @return \Symfony\Component\Finder\SplFileInfo
     */
    protected function getTestFile($fileName)
    {
        $fileName = $fileName . '_a.php';
        $relativePath = $this->getFixtureDir() . $fileName;

        return new SplFileInfo($relativePath, $relativePath, $relativePath);
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    protected function getExpectedContent($fileName)
    {
        return file_get_contents($this->getFixtureDir() . $fileName . '_b.php');
    }

    /**
     * @return string
     */
    protected function getFixtureDir()
    {
        $reflectionClass = new \ReflectionClass($this);
        $fixtureDirectory = __DIR__ . '/Fixtures/' . $reflectionClass->getShortName() . '/';

        return $fixtureDirectory;
    }

}
