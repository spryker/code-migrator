<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Updater;

use Spryker\AbstractUpdater;
use Symfony\Component\Finder\SplFileInfo;

class UseStatementReplace extends AbstractUpdater
{

    /**
     * @var array
     */
    protected $searchAndReplace;

    /**
     * @param array $searchAndReplace
     */
    public function __construct(array $searchAndReplace)
    {
        $this->searchAndReplace = $searchAndReplace;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return string
     */
    public function execute(SplFileInfo $fileInfo, $content)
    {
        foreach ($this->searchAndReplace as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }

}
