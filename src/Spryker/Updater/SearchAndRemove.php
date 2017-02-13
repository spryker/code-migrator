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
 * - Removes the found string.
 *
 */
class SearchAndRemove extends AbstractUpdater
{

    const MESSAGE_TEMPLATE_REMOVED = 'Removed "<fg=green>%s</>"';

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
        foreach ($this->configuration as $search) {
            if (preg_match('/' . preg_quote($search, '/') . '/', $content)) {

                $content = str_replace($search, '', $content);
                $message = sprintf(static::MESSAGE_TEMPLATE_REMOVED, rtrim($search, '\\'));
                $this->outputMessage($message);
            }
        }

        return $content;
    }

}
