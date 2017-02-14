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
 * - Replaces exact use statements (use Foo\Bar;), this should be used when you know there can't be an alias.
 * - Replaces use statement starting with (use Foo\Bar{\Anything\Else}), this should be used when you need to replace multiple occurrences.
 *
 * Configuration can be like this:
 */
class SearchAndReplace extends AbstractMigrator
{

    const MESSAGE_TEMPLATE_REPLACED = 'Replaced "<fg=green>%s</>" with "<fg=green>%s</>"';

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
        foreach ($this->configuration as $search => $replace) {
            if (preg_match('/' . preg_quote($search, '/') . '/', $content)) {

                if (preg_match('/' . preg_quote($replace, '/') . '/', $content)) {
                    continue;
                }

                $content = str_replace($search, $replace, $content);
                $message = sprintf(static::MESSAGE_TEMPLATE_REPLACED, rtrim($search, '\\'), rtrim($replace, '\\'));
                $this->outputMessage($message);
            }
        }

        return $content;
    }

}
