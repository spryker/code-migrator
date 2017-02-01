<?php

define('PROJECT_ROOT', realpath(__DIR__ . '/../../../../'));
define('PROJECT_NAMESPACE', 'Pyz');

require_once PROJECT_ROOT . '/vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Spryker\Updater\ConstantsReplace;
use Spryker\Command\UpdaterCommand;

$updaterCommand = new UpdaterCommand();
$updaterCommand->addUpdater(new ConstantsReplace([
    'ApplicationConstants::PROJECT_NAMESPACE' => 'KernelConstants::PROJECT_NAMESPACE'
]));

$application = new Application();
$application->add($updaterCommand);
$application->run();
