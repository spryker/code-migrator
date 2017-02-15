<?php

return [
    'use Spryker\\\\(?:Yves|Zed|Shared|Client)\\\\Library\\\\(?!DataDirectory)(?:.*?);',
    'Spryker\\\\Shared\\\\Library\\\\DataDirectory' => 'You need to replace the usage with e.g. APPLICATION_ROOT_DIR . \'/data/\' . Store::getInstance()->getStoreName() . \'/foo/bar\'',
    'use Spryker\\\\Zed\\\\Messenger\\\\Business\\\\Model\\\\MessengerInterface' => 'UseStatementReplace was not able to replace this use statement, maybe you use this with an alias',
    'use ' . PROJECT_NAMESPACE . '\\\\Yves\\\\Product\\\\Plugin\\\\TwigProductImagePlugin',
    'public function getCheckSteps\(' => 'You can remove this method, use proper CI for testing',
    'System::getHostname()' => 'Please use UtilNetworkService::getHostName() instead',
];
