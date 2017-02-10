<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Updater;
use Spryker\Updater\DuplicateConfigConstant;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group DuplicateConfigConstantTest
 */
class DuplicateConfigConstantTest extends AbstractTest
{

    const TEST_FILE_NEW_CONSTANT_IN_PROJECT = 'contains_constant_new_constant_in_project';
    const TEST_FILE_NEW_CONSTANT_IN_CORE = 'contains_constant_new_constant_in_core';
    const DO_NOT_ADD_NEW_USE_WHEN_IT_EXISTS = 'do_not_add_new_use_when_it_exists';

    const OLD_CONSTANT = 'ApplicationConstants::OLD_CONSTANT';
    const NEW_CONSTANT = 'OtherBundleConstants::NEW_CONSTANT';

    /**
     * @return void
     */
    public function testWhenOldConstantFoundAndBundleNotUsedNoMessageIsPrintedToUser()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_NEW_CONSTANT_IN_PROJECT);

        $configuration = [
            static::OLD_CONSTANT => [static::NEW_CONSTANT],
        ];

        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->method('accept')->willReturn(true);
        $updaterMock->method('askQuestion')->willReturn(false);
        $updaterMock->expects($this->once())->method('outputMessage');
        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenFileNotAConfigFileAcceptShouldReturnFalse()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_NEW_CONSTANT_IN_PROJECT);
        $updater = new DuplicateConfigConstant([]);

        $this->assertFalse($updater->accept($testFile));
    }

    /**
     * @return void
     */
    public function testWhenOldConstantFoundAndBundleIsUsedNewConfigIsAdded()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_NEW_CONSTANT_IN_PROJECT);

        $configuration = [
            static::OLD_CONSTANT => [static::NEW_CONSTANT],
        ];

        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->method('accept')->willReturn(true);
        $updaterMock->method('askQuestion')->willReturn(true);
        $expectedMessage = sprintf(DuplicateConfigConstant::MESSAGE_TEMPLATE_ADDED_CONFIG, static::NEW_CONSTANT, static::OLD_CONSTANT);
        $updaterMock->expects($this->at(2))->method('outputMessage')->with($this->equalTo($expectedMessage));
        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenOldConstantFoundAndBundleIsUsedAndNewConstantExistsInProjectProjectUseIsAdded()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_NEW_CONSTANT_IN_PROJECT);

        $configuration = [
            static::OLD_CONSTANT => [static::NEW_CONSTANT],
        ];

        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->method('accept')->willReturn(true);
        $updaterMock->method('askQuestion')->willReturn(true);
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(true);

        $newUseStatement = 'Pyz\Shared\OtherBundle\OtherBundleConstants';
        $addUseAfter = 'Spryker\Shared\Application\ApplicationConstants';
        $expectedMessage = sprintf(DuplicateConfigConstant::MESSAGE_TEMPLATE_ADDED_USE, $newUseStatement, $addUseAfter);
        $updaterMock->expects($this->at(4))->method('outputMessage')->with($this->equalTo($expectedMessage));

        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::TEST_FILE_NEW_CONSTANT_IN_PROJECT), $content);
    }

    /**
     * @return void
     */
    public function testWhenOldConstantFoundAndBundleIsUsedAndNewConstantExistsInCoreCoreUseIsAdded()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_NEW_CONSTANT_IN_CORE);

        $configuration = [
            static::OLD_CONSTANT => [static::NEW_CONSTANT],
        ];

        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->method('accept')->willReturn(true);
        $updaterMock->method('askQuestion')->willReturn(true);
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(false);

        $newUseStatement = 'Spryker\Shared\OtherBundle\OtherBundleConstants';
        $addUseAfter = 'Spryker\Shared\Application\ApplicationConstants';
        $expectedMessage = sprintf(DuplicateConfigConstant::MESSAGE_TEMPLATE_ADDED_USE, $newUseStatement, $addUseAfter);
        $updaterMock->expects($this->at(4))->method('outputMessage')->with($this->equalTo($expectedMessage));

        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::TEST_FILE_NEW_CONSTANT_IN_CORE), $content);
    }

    /**
     * @return void
     */
    public function testUseIsNotAddedWhenItAlreadyExistsInCoreCoreUseIsAdded()
    {
        $testFile = $this->getTestFile(static::DO_NOT_ADD_NEW_USE_WHEN_IT_EXISTS);

        $configuration = [
            static::OLD_CONSTANT => [static::NEW_CONSTANT],
        ];

        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->method('accept')->willReturn(true);
        $updaterMock->method('askQuestion')->willReturn(true);
        $updaterMock->method('existsNewConstantClassInProject')->willReturn(false);

        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::DO_NOT_ADD_NEW_USE_WHEN_IT_EXISTS), $content);
    }

    /**
     * @param array $configuration
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|DuplicateConfigConstant
     */
    protected function getUpdaterMock(array $configuration)
    {
        $mockBuilder = $this->getMockBuilder(DuplicateConfigConstant::class);
        $mockBuilder->setConstructorArgs([$configuration])
            ->setMethods(['outputMessage', 'accept', 'askQuestion', 'existsNewConstantClassInProject']);

        return $mockBuilder->getMock();
    }
}
