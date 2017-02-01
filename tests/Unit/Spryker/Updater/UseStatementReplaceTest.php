<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */


namespace Unit\Spryker\Updater;

use Spryker\Updater\UseStatementReplace;

class UseStatementReplaceTest extends AbstractUpdaterTest
{

    const USE_STATEMENT_REPLACE = 'use_statement_replace';

    /**
     * @return void
     */
    public function testUseStatementIsReplaced()
    {
        $testFile = $this->getTestFile(self::USE_STATEMENT_REPLACE);

        $updater = new UseStatementReplace(['use Spryker\Foo\Bar\Baz' => 'use Spryker\Baz\Bar\Foo']);
        $content = $updater->execute($testFile, $testFile->getContents());

        $this->assertSame($this->getExpectedContent(self::USE_STATEMENT_REPLACE), $content);
    }

    /**
     * @return UseStatementReplace
     */
    protected function getUpdater()
    {
        $updater = new UseStatementReplace(['use Spryker\Foo\Bar\Baz' => 'use Spryker\Baz\Bar\Foo']);

        return $updater;
    }

}
