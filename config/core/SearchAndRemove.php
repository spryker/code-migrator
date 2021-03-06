<?php

return [
    'new ApplicationIntegrationCheckConsole(),',
    'use Spryker\Zed\Application\Communication\Console\ApplicationIntegrationCheckConsole;',
    'use Spryker\Shared\Library\System;',
    'use Spryker\Shared\Library\Context;',
    'use Spryker\Shared\Library\DateFormatter;',
    'use Spryker\Shared\Library\DataDirectory;',
    '$config[ApplicationConstants::ALLOW_INTEGRATION_CHECKS] = true;',
    '$config[ApplicationConstants::ALLOW_INTEGRATION_CHECKS] = false;',
    '$config[ApplicationConstants::TRANSFER_SSL] = false;',
    '$config[ApplicationConstants::TRANSFER_SSL] = true;',
    '$this->application->register(new MonologServiceProvider());',
];
