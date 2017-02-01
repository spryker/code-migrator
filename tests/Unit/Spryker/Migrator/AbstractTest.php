<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Migrator;

use PHPUnit_Framework_TestCase;
use ReflectionClass;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group AbstractTest
 */
abstract class AbstractTest extends PHPUnit_Framework_TestCase
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
        $reflectionClass = new ReflectionClass($this);
        $fixtureDirectory = __DIR__ . '/Fixtures/' . $reflectionClass->getShortName() . '/';

        return $fixtureDirectory;
    }

}
