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
 * - Outputs a message, when a constant is used but was removed in core.
 * - If configuration contains additional message, then this is also printed to the user.
 *
 * Configuration can be like this:
 * ```
 * $configuration = [
 *      'BundleConstants::CONSTANT_NAME_A',
 *      'BundleConstants::CONSTANT_NAME_B' => 'Additional message',
 * ];
 * ```
 */
class ConstantRemoved extends AbstractUpdater
{

    const MESSAGE_PATTERN = 'Constant "<fg=green>%s</>" is removed from core but was found';

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $messagePattern;

    /**
     * @param array $configuration
     * @param string $messagePattern
     */
    public function __construct(array $configuration, $messagePattern = self::MESSAGE_PATTERN)
    {
        $this->configuration = $configuration;
        $this->messagePattern = $messagePattern;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return string
     */
    public function execute(SplFileInfo $fileInfo, $content)
    {
        $constantCollection = $this->getConstantCollection();
        foreach ($constantCollection as $constant) {
            if (preg_match('/' . $constant . '/', $content)) {
                $this->outputConstantRemovedMessage($constant, $fileInfo);
            }
        }

        return $content;
    }

    /**
     * @return array
     */
    protected function getConstantCollection()
    {
        $constantCollection = [];
        foreach ($this->configuration as $key => $value) {
            if (is_string($key)) {
                $constantCollection[] = $key;
            } else {
                $constantCollection[] = $value;
            }
        }

        return $constantCollection;
    }

    /**
     * @param string $constant
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return void
     */
    protected function outputConstantRemovedMessage($constant, SplFileInfo $fileInfo)
    {
        $message = sprintf(self::MESSAGE_PATTERN, $constant);
        $this->outputMessage($message);

        if (isset($this->configuration[$constant])) {
            $this->outputMessage($this->configuration[$constant]);
        }

        $message = sprintf(static::MESSAGE_TEMPLATE_FILE_NAME, $fileInfo->getPathname());
        $this->outputMessage($message);
        $this->outputMessage(static::MESSAGE_MANUALLY);
    }

}
