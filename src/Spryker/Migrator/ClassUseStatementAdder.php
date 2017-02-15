<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Migrator;

use Spryker\AbstractMigrator;
use Symfony\Component\Finder\SplFileInfo;

class ClassUseStatementAdder extends AbstractMigrator
{

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return string
     */
    public function execute(SplFileInfo $fileInfo, $content)
    {
        foreach ($this->configuration as $fileNamePattern => $useStatementCollection) {
            if (strpos($fileInfo->getPathname(), $fileNamePattern) === false) {
                continue;
            }
            foreach ($useStatementCollection as $useStatement) {
                $content = $this->addUseStatementToFile($useStatement, $content, $fileInfo);
            }
        }

        return $content;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return bool
     */
    public function accept(SplFileInfo $fileInfo)
    {
        foreach ($this->configuration as $fileNamePattern => $constants) {
            if (strpos($fileInfo->getPathname(), $fileNamePattern) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $useStatement
     * @param string $content
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return mixed
     */
    protected function addUseStatementToFile($useStatement, $content, SplFileInfo $fileInfo)
    {
        if (preg_match('/' . preg_quote($useStatement, '/') . '/', $content)) {
            return $content;
        }

        $namespacePattern = '/^namespace\s(.*?);/m';
        if (preg_match($namespacePattern, $content, $matches)) {
            $search = $matches[0];
            $replace = $search . PHP_EOL . PHP_EOL . $useStatement;
            $content = str_replace($search, $replace, $content);

            $this->outputMessage(sprintf('Added "%s" to "%s"', $useStatement, $fileInfo->getFilename()));
        }

        return $content;
    }

}
