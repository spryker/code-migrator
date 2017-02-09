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
 * - Class just outputs the a message when SearchPattern matches.
 * - If configuration contains additional message, then this is also printed to the user.
 *
 * Configuration can be like this:
 * ```
 * $configuration = [
 *      'SearchPattern',
 *      'SearchPattern' => 'Additional message',
 * ];
 * ```
 */
class UseFinder extends AbstractUpdater
{

    const MESSAGE_TEMPLATE_FOUND_USE = 'Found use of "<fg=green>%s</>"';

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
        foreach ($this->configuration as $key => $value) {
            if (is_string($key)) {
                $pattern = $key;
            } else {
                $pattern = $value;
            }
            if (preg_match('/' . $pattern . '/', $content)) {
                $this->outputMessages($pattern, $fileInfo);
            }
        }

        return $content;
    }

    /**
     * @param string $pattern
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return void
     */
    protected function outputMessages($pattern, SplFileInfo $fileInfo)
    {
        $message = sprintf(static::MESSAGE_TEMPLATE_FOUND_USE, $pattern);
        $this->outputMessage($message);

        if (isset($this->configuration[$pattern])) {
            $this->outputMessage($this->configuration[$pattern]);
        }

        $message = sprintf(static::MESSAGE_TEMPLATE_FILE_NAME, $fileInfo->getPathname());
        $this->outputMessage($message);

        $this->outputMessage(static::MESSAGE_MANUALLY);
    }

}
