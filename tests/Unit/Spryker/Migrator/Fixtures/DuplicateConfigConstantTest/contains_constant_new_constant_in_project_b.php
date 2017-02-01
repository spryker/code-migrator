<?php

use Spryker\Shared\Application\ApplicationConstants;
use Pyz\Shared\OtherBundle\OtherBundleConstants;

$config[ApplicationConstants::OLD_CONSTANT]
    = $config[OtherBundleConstants::NEW_CONSTANT] = 'Foo';
