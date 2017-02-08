<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Updater;

use Spryker\Updater\UseFinder;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group UseFinderTest
 */
class UseFinderTest extends AbstractTest
{

    const CONTAINS_LIBRARY_USE = 'contains_use';
    const SEARCH_PATTERN_FOUND = 'use Spryker\\\\(?:Yves|Zed|Shared|Client)\\\\Library\\\\(?:.*?);';
    const SEARCH_PATTERN_NOT_FOUND = 'use Foo\\\\(?:Yves|Zed|Shared|Client)\\\\Bar\\\\(?:.*?);';
    const ADDITIONAL_MESSAGE = 'Additional message';

    /**
     * @return void
     */
    public function testWhenUseStatementFoundOutputMessagesIsCalled()
    {
        $testFile = $this->getTestFile(static::CONTAINS_LIBRARY_USE);

        $configuration = [
            static::SEARCH_PATTERN_FOUND,
        ];
        $updater = $this->getUpdaterMock($configuration);
        $updater->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenUseStatementNotFoundOutputMessagesIsNotCalled()
    {
        $testFile = $this->getTestFile(static::CONTAINS_LIBRARY_USE);

        $configuration = [
            static::SEARCH_PATTERN_NOT_FOUND,
        ];
        $updater = $this->getUpdaterMock($configuration);
        $updater->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenConfigurationContainsAdditionalMessageAndUseStatementIsFoundOutputMessageIsCalledWithAdditionalMessage()
    {
        $testFile = $this->getTestFile(static::CONTAINS_LIBRARY_USE);

        $configuration = [
            static::SEARCH_PATTERN_FOUND => static::ADDITIONAL_MESSAGE,
        ];
        $updaterMock = $this->getUpdaterMock($configuration);
        $expectedAdditionalMessage = static::ADDITIONAL_MESSAGE;
        $updaterMock->expects($this->at(1))->method('outputMessage')->with($expectedAdditionalMessage);
        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @param array $configuration
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Updater\UseFinder
     */
    protected function getUpdaterMock(array $configuration)
    {
        $updaterMockBuilder = $this->getMockBuilder(UseFinder::class)
            ->setConstructorArgs([$configuration])
            ->setMethods(['outputMessage']);

        return $updaterMockBuilder->getMock();
    }

}
