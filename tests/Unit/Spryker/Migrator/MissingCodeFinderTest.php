<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Migrator;

use Spryker\Migrator\MissingCodeFinder;

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

    const CODE_BLOCK = '
public function foo()
{
    return \'bar\';
}    
    ';

    const MESSAGE = 'Additional message';

    /**
     * @return void
     */
    public function testDoesNotRunWhenCurrentFileIsNotConfigured()
    {
        $testFile = $this->getTestFile(self::TEST_FILE_MISSING_CODE_BLOCK);
        $configuration = [
            'not_matching_file_name.php' => [
                [
                    MissingCodeFinder::OPTION_SEARCH => static::SEARCH_PATTERN,
                    MissingCodeFinder::OPTION_CODE => '',
                ],
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
                [
                    MissingCodeFinder::OPTION_SEARCH => static::SEARCH_PATTERN,
                    MissingCodeFinder::OPTION_CODE => static::CODE_BLOCK,
                ],
            ],
        ];
        $expectedMessage = sprintf(MissingCodeFinder::MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND, static::SEARCH_PATTERN);
        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->expects($this->at(0))->method('outputMessage')->with($this->equalTo($expectedMessage));

        $expectedMessage = sprintf(MissingCodeFinder::MESSAGE_TEMPLATE_CODE_BLOCK, static::CODE_BLOCK);
        $updaterMock->expects($this->at(1))->method('outputMessage')->with($this->equalTo($expectedMessage));
        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testWhenConfigurationHasMessageMessageIsPrintedToTheUser()
    {
        $testFile = $this->getTestFile(self::TEST_FILE_MISSING_CODE_BLOCK);
        $configuration = [
            $testFile->getFilename() => [
                [
                    MissingCodeFinder::OPTION_SEARCH => static::SEARCH_PATTERN,
                    MissingCodeFinder::OPTION_CODE => static::CODE_BLOCK,
                    MissingCodeFinder::OPTION_MESSAGE => static::MESSAGE,
                ],
            ],
        ];
        $updaterMock = $this->getUpdaterMock($configuration);
        $expectedMessage = static::MESSAGE;
        $updaterMock->expects($this->at(3))->method('outputMessage')->with($this->equalTo($expectedMessage));
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
