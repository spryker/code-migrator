<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Updater;

use Spryker\Updater\UseStatementReplace;

/**
 * @group Unit
 * @group Spryker
 * @group Updater
 * @group UseStatementReplaceTest
 */
class UseStatementReplaceTest extends AbstractTest
{

    const USE_STATEMENT_REPLACE_EXACTLY = 'use_statement_replace';
    const USE_SEARCH_EXACTLY = 'use Spryker\Foo\Bar\Baz';
    const USE_REPLACE_EXACTLY = 'use Spryker\Baz\Bar\Foo';

    const USE_STATEMENT_REPLACE_PARTIALLY = 'use_statement_replace_multiple';
    const USE_SEARCH_PARTIALLY = 'use Spryker\Foo\Bar\\';
    const USE_REPLACE_PARTIALLY = 'use Spryker\Baz\Bar\\';

    const USE_STATEMENT_REPLACE_ALIASED = 'use_statement_replace_with_alias';
    const USE_SEARCH_ALIASED = 'use Foo\Bar\Baz\Zip;';
    const USE_REPLACE_ALIASED = 'use Zip\Baz\Bar\Foo as Zip;';

    /**
     * Exact in this context means a complete code line e.g.:
     * use Foo\Bar\Baz\Bat;
     *
     * @return void
     */
    public function testExactUseStatementIsReplaced()
    {
        $testFile = $this->getTestFile(self::USE_STATEMENT_REPLACE_EXACTLY);

        $updaterMock = $this->getUpdaterMock([static::USE_SEARCH_EXACTLY => static::USE_REPLACE_EXACTLY]);
        $expectedMessage = $this->getExpectedMessage(static::USE_SEARCH_EXACTLY, static::USE_REPLACE_EXACTLY);
        $updaterMock->expects($this->once())->method('outputMessage')->with($expectedMessage);

        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::USE_STATEMENT_REPLACE_EXACTLY), $content);
    }

    /**
     * Partially in this context means a use starts with e.g.:
     * use Foo\Bar\Baz\Bat{\Anything\Else}
     *
     * @return void
     */
    public function testUseStatementIsReplacedMultipleTime()
    {
        $testFile = $this->getTestFile(self::USE_STATEMENT_REPLACE_PARTIALLY);

        $updaterMock = $this->getUpdaterMock([static::USE_SEARCH_PARTIALLY => static::USE_REPLACE_PARTIALLY]);
        $expectedMessage = $this->getExpectedMessage(static::USE_SEARCH_PARTIALLY, static::USE_REPLACE_PARTIALLY);
        $updaterMock->expects($this->once())->method('outputMessage')->with($expectedMessage);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::USE_STATEMENT_REPLACE_PARTIALLY), $content);
    }

    /**
     * @return void
     */
    public function testUseStatementIsReplacedAndAliased()
    {
        $testFile = $this->getTestFile(self::USE_STATEMENT_REPLACE_ALIASED);

        $updaterMock = $this->getUpdaterMock([static::USE_SEARCH_ALIASED => static::USE_REPLACE_ALIASED]);
        $expectedMessage = $this->getExpectedMessage(static::USE_SEARCH_ALIASED, static::USE_REPLACE_ALIASED);
        $updaterMock->expects($this->once())->method('outputMessage')->with($expectedMessage);
        $content = $updaterMock->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(static::USE_STATEMENT_REPLACE_ALIASED), $content);
    }

    /**
     * @param array $configuration
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Updater\UseStatementReplace
     */
    protected function getUpdaterMock(array $configuration)
    {
        $mockBuilder = $this->getMockBuilder(UseStatementReplace::class);
        $mockBuilder->setConstructorArgs([$configuration])
            ->setMethods(['outputMessage']);

        return $mockBuilder->getMock();
    }

    /**
     * @param string $search
     * @param string $replace
     *
     * @return string
     */
    protected function getExpectedMessage($search, $replace)
    {
        $expectedMessage = sprintf(
            UseStatementReplace::MESSAGE_TEMPLATE_REPLACED,
            rtrim($search, '\\'),
            rtrim($replace, '\\')
        );

        return $expectedMessage;
    }

}
