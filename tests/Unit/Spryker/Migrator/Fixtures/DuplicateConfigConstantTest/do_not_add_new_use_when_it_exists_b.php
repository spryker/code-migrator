<?php

use Pyz\Shared\Application\ApplicationConstants;
use Spryker\Shared\OtherBundle\OtherBundleConstants;

$config = [];
$config[ApplicationConstants::OLD_CONSTANT]
    = $config[OtherBundleConstants::NEW_CONSTANT] = 'Something';
