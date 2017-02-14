<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Migrator;

use Spryker\Migrator\ClassConstantAdder;
use Spryker\Migrator\ClassMethodAdder;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group ClassMethodAdderTest
 */
class ClassMethodAdderTest extends AbstractTest
{

    const TEST_FILE = 'add_class_method';

    /**
     * @return void
     */
    public function testNewMethodIsAddedBeforeClosingBrace()
    {
        $testFile = $this->getTestFile(static::TEST_FILE);
        $configuration = [
            $testFile->getFilename() => [
                'public function doSomething()' => '    /**
     * @return string
     */
    public function doSomething()
    {
        return \'something\';
    }',
            ],
        ];

        $updater = new ClassMethodAdder($configuration);
        $content = $updater->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::TEST_FILE), $content);
    }

}
