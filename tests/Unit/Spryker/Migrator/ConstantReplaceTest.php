<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Migrator;

use Spryker\Migrator\ConstantReplace;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group ConstantReplaceTest
 */
class ConstantReplaceTest extends AbstractTest
{

    const ADD_PROJECT_AFTER_PROJECT = 'add_project_after_project';
    const ADD_PROJECT_AFTER_CORE = 'add_project_after_core';
    const ADD_CORE_AFTER_PROJECT = 'add_core_after_project';
    const ADD_CORE_AFTER_CORE = 'add_core_after_core';
    const DO_NOT_ADD_NEW_USE_WHEN_IT_EXISTS = 'do_not_add_new_use_when_it_exists';

    /**
     * @return void
     */
    public function testAddNewProjectConstantAfterOldProjectConstant()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(true);

        $testFile = $this->getTestFile(static::ADD_PROJECT_AFTER_PROJECT);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::ADD_PROJECT_AFTER_PROJECT), $content);
    }

    /**
     * @return void
     */
    public function testAddNewProjectConstantAfterOldCoreConstant()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(true);

        $testFile = $this->getTestFile(static::ADD_PROJECT_AFTER_CORE);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::ADD_PROJECT_AFTER_CORE), $content);
    }

    /**
     * @return void
     */
    public function testAddNewCoreConstantAfterOldProjectConstant()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(false);

        $testFile = $this->getTestFile(static::ADD_CORE_AFTER_PROJECT);
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

        $testFile = $this->getTestFile(static::ADD_CORE_AFTER_CORE);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(self::ADD_CORE_AFTER_CORE), $content);
    }

    /**
     * @return void
     */
    public function testUseIsNotAddedWhenItAlreadyExists()
    {
        $updaterMock = $this->getUpdater();
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(false);

        $testFile = $this->getTestFile(static::DO_NOT_ADD_NEW_USE_WHEN_IT_EXISTS);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::DO_NOT_ADD_NEW_USE_WHEN_IT_EXISTS), $content);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Migrator\ConstantReplace
     */
    protected function getUpdater()
    {
        $updaterMockBuilder = $this->getMockBuilder(ConstantReplace::class)
            ->setConstructorArgs([['ApplicationConstants::FOO_BAR' => 'KernelConstants::FOO_BAR']])
            ->setMethods(['existsNewConstantClassInProject', 'outputMessage']);

        return $updaterMockBuilder->getMock();
    }

}
