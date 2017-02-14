<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Migrator;

use Spryker\AbstractMigrator;
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
 *          [
 *              'search' => 'search pattern',
 *              'code' => 'Code block',
 *          ],
 *          [
 *              'search' => 'search pattern',
 *              'code' => 'Code block',
 *              'message' => 'Additional message',
 *          ],
 *      ],
 * ];
 * ```
 */
class MissingCodeFinder extends AbstractMigrator
{

    const MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND = 'Missing code block found, searched for "<fg=green>%s</>", you need to add the following code block manually';
    const MESSAGE_TEMPLATE_CODE_BLOCK = '<fg=yellow>[<fg=red>CODE</>]</>' . PHP_EOL . '%s' . PHP_EOL . '<fg=yellow>[<fg=red>/CODE</>]</>';

    const OPTION_SEARCH = 'search';
    const OPTION_CODE = 'code';
    const OPTION_MESSAGE = 'message';

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
        foreach ($this->configuration as $filePathPattern => $optionsCollection) {
            if (preg_match('/' . preg_quote($filePathPattern, '/') . '/', $fileInfo->getPathname())) {
                foreach ($optionsCollection as $options) {
                    $search = $options[self::OPTION_SEARCH];
                    if (!preg_match('/' . preg_quote($search, '/') . '/', $content)) {
                        $this->outputMessages($options, $fileInfo);
                    }
                }
            }
        }

        return $content;
    }

    /**
     * @param array $options
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return void
     */
    protected function outputMessages(array $options, SplFileInfo $fileInfo)
    {
        $search = $options[static::OPTION_SEARCH];
        $message = sprintf(static::MESSAGE_TEMPLATE_MISSING_CODE_BLOCK_FOUND, $search);
        $this->outputMessage($message);

        $code = $options[static::OPTION_CODE];
        $this->outputMessage(sprintf(static::MESSAGE_TEMPLATE_CODE_BLOCK, $code));

        $message = sprintf(static::MESSAGE_TEMPLATE_FILE_NAME, $fileInfo->getPathname());
        $this->outputMessage($message);

        if (isset($options[static::OPTION_MESSAGE])) {
            $this->outputMessage($options[static::OPTION_MESSAGE]);
        }

        $this->outputMessage(static::MESSAGE_MANUALLY);
    }

}
