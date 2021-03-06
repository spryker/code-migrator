<?php

define('PROJECT_ROOT', realpath(__DIR__ . '/../../../../'));

require_once PROJECT_ROOT . '/vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Spryker\Command\MigratorCommand;
use Symfony\Component\Console\Application;

$updaterCommand = new MigratorCommand();

$application = new Application();
$application->add($updaterCommand);
$application->run();
