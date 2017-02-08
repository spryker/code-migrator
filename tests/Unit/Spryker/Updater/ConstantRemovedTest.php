<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Updater;

use Spryker\Updater\ConstantRemoved;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group ConstantRemovedTest
 */
class ConstantRemovedTest extends AbstractTest
{

    const CONTAINS_CONSTANT = 'contains_constant';
    const CONSTANT_TO_FIND = 'ConstantToFind::FOO_BAR';
    const CONSTANT_NOT_TO_FIND = 'ConstantNotToFind::FOO_BAR';
    const ADDITIONAL_MESSAGE = 'Additional message';

    /**
     * @return void
     */
    public function testWhenConstantFoundOutputMessageIsCalled()
    {
        $testFile = $this->getTestFile(static::CONTAINS_CONSTANT);

        $updaterMock = $this->getUpdaterMock([static::CONSTANT_TO_FIND]);
        $expectedMessage = sprintf(ConstantRemoved::MESSAGE_PATTERN, static::CONSTANT_TO_FIND);
        $updaterMock->expects($this->at(0))->method('outputMessage')->with($expectedMessage);

        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenConfigurationContainsAdditionalMessageAndConstantFoundOutputMessageIsCalledWithAdditionalMessage()
    {
        $testFile = $this->getTestFile(static::CONTAINS_CONSTANT);

        $updaterMock = $this->getUpdaterMock([static::CONSTANT_TO_FIND => static::ADDITIONAL_MESSAGE]);
        $expectedMessage = sprintf(ConstantRemoved::MESSAGE_PATTERN, static::CONSTANT_TO_FIND);
        $expectedAdditionalMessage = static::ADDITIONAL_MESSAGE;

        $updaterMock->method('outputMessage')->withConsecutive(
            [$this->equalTo($expectedMessage)],
            [$this->equalTo($expectedAdditionalMessage)]
        );

        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenConstantNotFoundOutputMessageIsNotCalled()
    {
        $testFile = $this->getTestFile(static::CONTAINS_CONSTANT);

        $updaterMock = $this->getUpdaterMock([static::CONSTANT_NOT_TO_FIND]);
        $updaterMock->expects($this->never())->method('outputMessage');

        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @param array $configuration
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Updater\ConstantRemoved
     */
    protected function getUpdaterMock(array $configuration)
    {
        $mockBuilder = $this->getMockBuilder(ConstantRemoved::class);
        $mockBuilder->setMethods(['outputMessage'])
            ->setConstructorArgs([$configuration]);

        return $mockBuilder->getMock();
    }

}
