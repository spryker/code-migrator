<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Updater;

use Spryker\AbstractUpdater;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Specification:
 * - Removes files given in configuration after user allows to remove.
 * - Asks user if file should be removed.
 *
 * ```
 * $configuration = [
 *      'FileNamePattern',
 * ]
 * ```
 */
class RemoveFile extends AbstractUpdater
{
    const MESSAGE_TEMPLATE_REMOVED_FILE = 'Removed "<fg=green>%s</>"';

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return bool
     */
    public function execute(SplFileInfo $fileInfo, $content)
    {
        if ($this->askIfFileCanBeRemoved($fileInfo)) {
            $this->removeFile($fileInfo);
            $message = sprintf(static::MESSAGE_TEMPLATE_REMOVED_FILE, $fileInfo->getFilename());
            $this->outputMessage($message);

        }
        return false;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return bool
     */
    protected function askIfFileCanBeRemoved(SplFileInfo $fileInfo)
    {
        $question = sprintf('Can i remove "<fg=green>%s</>"?', $fileInfo->getPathname());

        return $this->askQuestion($question);
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return void
     */
    protected function removeFile(SplFileInfo $fileInfo)
    {
        unlink($fileInfo->getPathname());
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return bool
     */
    public function accept(SplFileInfo $fileInfo)
    {
        foreach ($this->configuration as $fileNamePattern) {
            if (strpos($fileInfo->getPathname(), $fileNamePattern) !== false) {
                return true;
            }
        }

        return false;
    }


}
