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

    const MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND = 'Missing code block found, searched for "<fg=green>%s</>", you need to add the following code block manually';
    const MESSAGE_TEMPLATE_CODE_BLOCK = '<fg=yellow>[<fg=red>CODE</>]</>' . PHP_EOL . '%s' . PHP_EOL . '<fg=yellow>[<fg=red>/CODE</>]</>';

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
        foreach ($this->configuration as $filePathPattern => $options) {
            if (preg_match('/' . preg_quote($filePathPattern, '/') . '/', $fileInfo->getPathname())) {
                foreach ($options as $search => $codeBlock) {
                    if (!preg_match('/' . preg_quote($search, '/') . '/', $content)) {
                        $this->outputMessages($filePathPattern, $search, $fileInfo);
                    }
                }
            }
        }

        return $content;
    }

    /**
     * @param string $configKey
     * @param string $search
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return void
     */
    protected function outputMessages($configKey, $search, SplFileInfo $fileInfo)
    {
        $message = sprintf(static::MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND, $search);
        $this->outputMessage($message);

        $codeBlock = $this->configuration[$configKey][$search];
        $this->outputMessage(sprintf(static::MESSAGE_TEMPLATE_CODE_BLOCK, $codeBlock));

        $message = sprintf(static::MESSAGE_TEMPLATE_FILE_NAME, $fileInfo->getPathname());
        $this->outputMessage($message);

        $this->outputMessage(static::MESSAGE_MANUALLY);
    }

}
