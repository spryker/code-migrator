<?php

use Pyz\Shared\Application\ApplicationConstants;
use Spryker\Shared\OtherBundle\OtherBundleConstants;

$config = [];
$config[ApplicationConstants::OLD_CONSTANT] = 'Something';

$config['FooBar'] = $config[ApplicationConstants::OLD_CONSTANT];
