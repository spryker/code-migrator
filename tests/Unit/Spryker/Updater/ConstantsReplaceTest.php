<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */


namespace Unit\Spryker\Updater;

use Spryker\Updater\ConstantsReplace;

class ConstantsReplaceTest extends AbstractUpdaterTest
{

    const ADD_PROJECT_AFTER_PROJECT = 'add_project_after_project';
    const ADD_PROJECT_AFTER_CORE = 'add_project_after_core';
    const ADD_CORE_AFTER_PROJECT = 'add_core_after_project';
    const ADD_CORE_AFTER_CORE = 'add_core_after_core';

    /**
     * @return void
     */
    public function testAddNewProjectConstantAfterOldProjectConstant()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(true);

        $testFile = $this->getTestFile(self::ADD_PROJECT_AFTER_PROJECT);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(self::ADD_PROJECT_AFTER_PROJECT), $content);
    }

    /**
     * @return void
     */
    public function testAddNewProjectConstantAfterOldCoreConstant()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(true);

        $testFile = $this->getTestFile(self::ADD_PROJECT_AFTER_CORE);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(self::ADD_PROJECT_AFTER_CORE), $content);
    }

    /**
     * @return void
     */
    public function testAddNewCoreConstantAfterOldProjectConstant()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(false);

        $testFile = $this->getTestFile(self::ADD_CORE_AFTER_PROJECT);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(self::ADD_CORE_AFTER_PROJECT), $content);
    }

    /**
     * @return void
     */
    public function testAddNewCoreConstantAfterOldCoreConstant()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(false);

        $testFile = $this->getTestFile(self::ADD_CORE_AFTER_CORE);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(self::ADD_CORE_AFTER_CORE), $content);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ConstantsReplace
     */
    protected function getUpdater()
    {
        $updaterMockBuilder = $this->getMockBuilder(ConstantsReplace::class)
            ->setConstructorArgs([['ApplicationConstants::FOO_BAR' => 'KernelConstants::FOO_BAR']])
            ->setMethods(['existsNewConstantClassInProject']);

        return $updaterMockBuilder->getMock();
    }

}
