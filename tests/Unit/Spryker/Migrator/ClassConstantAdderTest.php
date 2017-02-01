<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Migrator;

use Spryker\Migrator\ClassConstantAdder;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group ClassConstantAdderTest
 */
class ClassConstantAdderTest extends AbstractTest
{

    const TEST_FILE = 'add_class_constant';

    public function testNewConstantAreAddedAfterOpeningBrace()
    {
        $testFile = $this->getTestFile(static::TEST_FILE);
        $configuration = [
            $testFile->getFilename() => [
                'const FOO = \'BAR\';',
                'const BAZ = \'BAT\';',
            ],
        ];

        $updaterMock = new ClassConstantAdder($configuration);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::TEST_FILE), $content);
    }

}
