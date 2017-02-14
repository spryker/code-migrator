<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Migrator;

use Spryker\Migrator\RemoveFile;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group RemoveFileTest
 */
class RemoveFileTest extends AbstractTest
{

    const FILE_TO_REMOVE = 'file_to_remove';


    /**
     * @dataProvider fileNamePatternProvider
     *
     * @param string $fileNamePattern
     *
     * @return void
     */
    public function testIfFileConfiguredForRemovalAcceptWillReturnTrue($fileNamePattern)
    {
        $testFile = $this->getTestFile(static::FILE_TO_REMOVE);
        $configuration = [
            $fileNamePattern,
        ];
        $updaterMock = $this->getUpdaterMock($configuration);

        $this->assertTrue($updaterMock->accept($testFile));
    }

    /**
     * @return array
     */
    public function fileNamePatternProvider()
    {
        $testFile = $this->getTestFile(static::FILE_TO_REMOVE);

        return [
            [$testFile->getFilename()],
            [$testFile->getPath()],
            [static::FILE_TO_REMOVE],
        ];
    }

    /**
     * @return void
     */
    public function testIfFileNotConfiguredForRemovalAcceptWillReturnFalse()
    {
        $testFile = $this->getTestFile(static::FILE_TO_REMOVE);
        $configuration = [
            'does/not/match',
        ];
        $updaterMock = $this->getUpdaterMock($configuration);

        $this->assertFalse($updaterMock->accept($testFile));
    }

    /**
     * @return void
     */
    public function testIfFileConfiguredForRemovalAndUserConfirmsFileIsRemoved()
    {
        $testFile = $this->getTestFile(static::FILE_TO_REMOVE);
        $configuration = [
            $testFile->getFilename(),
        ];
        $updaterMock = $this->getUpdaterMock($configuration);
        $updaterMock->expects($this->once())->method('askQuestion')->willReturn(true);
        $updaterMock->expects($this->once())->method('removeFile');
        $expectedMessage = $message = sprintf(RemoveFile::MESSAGE_TEMPLATE_REMOVED_FILE, $testFile->getFilename());
        $updaterMock->expects($this->once())->method('outputMessage')->with($this->equalTo($expectedMessage));

        $updaterMock->execute($testFile, $testFile->getContents());
    }

    /**
     * @return void
     */
    public function testReturnsAlwaysFalse()
    {
        $testFile = $this->getTestFile(static::FILE_TO_REMOVE);
        $updater = $this->getUpdaterMock([]);

        $this->assertFalse($updater->execute($testFile, $testFile->getContents()));
    }

    /**
     * @param array $configuration
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Migrator\RemoveFile
     */
    protected function getUpdaterMock(array $configuration)
    {
        $mockBuilder = $this->getMockBuilder(RemoveFile::class);
        $mockBuilder->setConstructorArgs([$configuration])
            ->setMethods(['outputMessage', 'askQuestion', 'removeFile']);

        return $mockBuilder->getMock();
    }

}
