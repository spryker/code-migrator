<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Migrator;

use Spryker\Migrator\ClassUseStatementAdder;

/**
 * @group Unit
 * @group Spryker
 * @group Migrator
 * @group ClassUseStatementAdderTest
 */
class ClassUseStatementAdderTest extends AbstractTest
{

    const TEST_FILE_ADD_USE_STATEMENT = 'add_use_statement';
    const TEST_FILE_USE_STATEMENT_EXISTS = 'use_statement_exists';

    /**
     * @return void
     */
    public function testWhenUseStatementNotExistsUseStatementIsAddedAfterNamespace()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_ADD_USE_STATEMENT);

        $configuration = [
            $testFile->getFilename() => [
                'use Foo\Bar\Baz;'
            ],
        ];

        $migrator = $this->getMigratorMock($configuration);
        $migrator->expects($this->once())->method('outputMessage');
        $content = $migrator->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::TEST_FILE_ADD_USE_STATEMENT), $content);
    }

    /**
     * @return void
     */
    public function testWhenUseStatementExistsUseStatementIsNotAddedAfterNamespace()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_USE_STATEMENT_EXISTS);

        $configuration = [
            $testFile->getFilename() => [
                'use Foo\Bar\Baz;'
            ],
        ];

        $migrator = new ClassUseStatementAdder($configuration);
        $content = $migrator->execute($testFile, $testFile->getContents());

        $this->assertSame($testFile->getContents(), $content);
    }

    /**
     * @return void
     */
    public function testWhenFileNameMatchesAcceptReturnTrue()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_ADD_USE_STATEMENT);

        $configuration = [
            $testFile->getFilename() => [
                'use Foo\Bar\Baz;'
            ],
        ];

        $migrator = new ClassUseStatementAdder($configuration);

        $this->assertTrue($migrator->accept($testFile));
    }

    /**
     * @return void
     */
    public function testWhenFileNameNotMatchesAcceptReturnFalse()
    {
        $testFile = $this->getTestFile(static::TEST_FILE_ADD_USE_STATEMENT);

        $configuration = [
            'Name/Which/Not/Matches.php' => [
                'use Foo\Bar\Baz;'
            ],
        ];

        $migrator = new ClassUseStatementAdder($configuration);

        $this->assertFalse($migrator->accept($testFile));
    }

    /**
     * @param array $configuration
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Migrator\ClassUseStatementAdder
     */
    protected function getMigratorMock(array $configuration)
    {
        $mockBuilder = $this->getMockBuilder(ClassUseStatementAdder::class);
        $mockBuilder->setConstructorArgs([$configuration])
            ->setMethods(['outputMessage']);

        return $mockBuilder->getMock();
    }

}
