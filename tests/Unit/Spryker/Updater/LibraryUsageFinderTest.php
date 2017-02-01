<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */


namespace Unit\Spryker\Updater;

use Spryker\Command\UpdaterCommand;
use Spryker\Updater\LibraryUsageFinder;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class LibraryUsageFinderTest extends AbstractUpdaterTest
{

    const CONTAINS_LIBRARY_USE = 'contains_library_use';

    /**
     * @return void
     */
    public function testWhenUseOfLibraryFoundMessageIsSend()
    {
        $command = new UpdaterCommand();
        $input = new ArrayInput(['name' => 'foo']);
        $outputMock = $this->getOutputMock();
        $outputMock->expects($this->exactly(3))->method('writeln');

        $testFile = $this->getTestFile(self::CONTAINS_LIBRARY_USE);

        $updater = new LibraryUsageFinder();
        $updater->configure($input, $outputMock, $command);
        $updater->execute($testFile, $testFile->getContents());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ConsoleOutput
     */
    protected function getOutputMock()
    {
        $outputMockBuilder = $this->getMockBuilder(ConsoleOutput::class)
            ->setMethods(['writeln']);

        $outputMock = $outputMockBuilder->getMock();

        return $outputMock;
    }
}
