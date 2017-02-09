<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker;

use Symfony\Component\Finder\SplFileInfo;

interface UpdaterInterface
{

    /**
     * Return false if you don't want the file to be saved
     *
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return string|bool
     */
    public function execute(SplFileInfo $fileInfo, $content);

    /**
     * Use this method in your Updater class to determine if this class should handle the given file.
     *
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return string
     */
    public function accept(SplFileInfo $fileInfo);

}
