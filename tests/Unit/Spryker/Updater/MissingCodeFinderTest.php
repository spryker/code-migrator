<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Updater;

use Spryker\Updater\MissingCodeFinder;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group MissingCodeFinderTest
 */
class MissingCodeFinderTest extends AbstractTest
{

    const TEST_FILE_MISSING_CODE_BLOCK = 'missing_code_block';

    const SEARCH_PATTERN = 'public function foo()';

    /**
     * @return void
     */
    public function testDoesNotRunWhenCurrentFileIsNotConfigured()
    {
        $testFile = $this->getTestFile(self::TEST_FILE_MISSING_CODE_BLOCK);
        $configuration = [
            'not_matching_file_name.php' => [
                static::SEARCH_PATTERN => '',
            ],
        ];
        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->expects($this->never())->method('outputMessage');
        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenCodeBlockNotFoundMessageIsPrintedToTheUser()
    {
        $testFile = $this->getTestFile(self::TEST_FILE_MISSING_CODE_BLOCK);
        $configuration = [
            $testFile->getFilename() => [
                static::SEARCH_PATTERN => '
public function foo()
{
    return \'bar\';
}',
            ],
        ];
        $expectedMessage = sprintf(MissingCodeFinder::MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND, static::SEARCH_PATTERN);
        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->expects($this->at(0))->method('outputMessage')->with($this->equalTo($expectedMessage));
        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @param array $configuration
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|MissingCodeFinder
     */
    protected function getUpdaterMock(array $configuration)
    {
        $mockBuilder = $this->getMockBuilder(MissingCodeFinder::class);
        $mockBuilder->setConstructorArgs([$configuration])
            ->setMethods(['outputMessage']);

        return $mockBuilder->getMock();
    }

}
