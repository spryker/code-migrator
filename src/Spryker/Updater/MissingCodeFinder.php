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
 * - SearchPattern for missing code blocks.
 * - Will only run for given file names, this could be e.g. AbstractFooBar.php
 * - If configuration key (SearchPattern) can not be found message is printed to the user.
 * - If configuration key can not be found configuration value (code block) is printed to the user.
 *
 * Configuration can be like this:
 * ```
 * $configuration = [
 *      'fileName' => [
 *          'SearchPattern' => 'Code block',
 *      ],
 * ];
 * ```
 */
class MissingCodeFinder extends AbstractUpdater
{

    const MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND = 'Missing code block found searched for "<fg=green>%s</>", you need to add the following code block manually';

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
     * @return string
     */
    public function execute(SplFileInfo $fileInfo, $content)
    {
        foreach ($this->configuration as $fileName => $options) {
            if ($fileInfo->getFilename() === $fileName) {
                foreach ($options as $search => $codeBlock) {
                    if (!preg_match('/' . $search . '/', $content)) {
                        $this->outputMessages($search, $fileInfo);
                    }
                }
            }
        }

        return $content;
    }

    /**
     * @param string $search
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return void
     */
    protected function outputMessages($search, SplFileInfo $fileInfo)
    {
        $message = sprintf(static::MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND, $search);
        $this->outputMessage($message);
        $this->outputMessage($this->configuration[$fileInfo->getFilename()][$search]);

        $message = sprintf(static::MESSAGE_TEMPLATE_FILE_NAME, $fileInfo->getPathname());
        $this->outputMessage($message);

        $this->outputMessage(static::MESSAGE_MANUALLY);
    }

}
