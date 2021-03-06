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
 * - Removes the found string.
 *
 */
class SearchAndRemove extends AbstractMigrator
{

    const MESSAGE_TEMPLATE_REMOVED = 'Removed "<fg=green>%s</>"';

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
