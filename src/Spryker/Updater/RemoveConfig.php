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
 * - Removes old configs.
 *
 * Configuration can be like this:
 * ```
 * $configuration = [
 *      '¢config[BundleConstants::CONSTANT_NAME_A] = 'foo',
 * ];
 * ```
 */
class RemoveConfig extends AbstractUpdater
{

    /**
     * @var
     */
    protected $configuration;

    public function execute(SplFileInfo $fileInfo, $content)
    {

    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return bool
     */
    public function accept(SplFileInfo $fileInfo)
    {
        if (preg_match('/config\/Shared\/config_/', $fileInfo->getPathname())) {
            return true;
        }

        return false;
    }

}
