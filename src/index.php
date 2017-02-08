<?php

define('PROJECT_ROOT', realpath(__DIR__ . '/../../../../'));
define('PROJECT_NAMESPACE', 'Pyz');

require_once PROJECT_ROOT . '/vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Spryker\Updater\ConstantRemoved;
use Spryker\Updater\UseFinder;
use Spryker\Updater\UseStatementReplace;
use Symfony\Component\Console\Application;
use Spryker\Updater\ConstantReplace;
use Spryker\Command\UpdaterCommand;

$updaterCommand = new UpdaterCommand();

/**
 * Constants to replace
 */
$constantReplace = new ConstantReplace([
    'ApplicationConstants::PROJECT_NAMESPACE' => 'KernelConstants::PROJECT_NAMESPACE',
    'ApplicationConstants::APPLICATION_SPRYKER_ROOT' => 'KernelConstants::SPRYKER_ROOT',
    'ApplicationConstants::CORE_NAMESPACES' => 'KernelConstants::CORE_NAMESPACES',
    'ApplicationConstants::ERROR_LEVEL' => 'ErrorHandlerConstants::ERROR_LEVEL',
    'ApplicationConstants::SET_REPEAT_DATA' => 'ZedRequestConstants::SET_REPEAT_DATA',
    'ApplicationConstants::TRANSFER_USERNAME' => 'ZedRequestConstants::TRANSFER_USERNAME',
    'ApplicationConstants::TRANSFER_PASSWORD' => 'ZedRequestConstants::TRANSFER_PASSWORD',
]);
//$updaterCommand->addUpdater($constantReplace);



/**
 * Constants removed
 */
$constantRemoved = new ConstantRemoved([
    'ApplicationConstants::TRANSFER_SSL',
    'ApplicationConstants::ALLOW_INTEGRATION_CHECKS',
]);

$updaterCommand->addUpdater($constantRemoved);

$useStatementReplace = new UseStatementReplace([
    'use Spryker\Zed\Acl\Communication\Plugin\Installer as AclInstallerPlugin' => 'use Spryker\Zed\Acl\Communication\Plugin\AclInstallerPlugin',
    'use Spryker\Zed\Country\Communication\Plugin\Installer as CountryInstallerPlugin' => 'use Spryker\Zed\Country\Communication\Plugin\CountryInstallerPlugin',
    'use Spryker\Zed\Glossary\Communication\Plugin\Installer as GlossaryInstallerPlugin' => 'use Spryker\Zed\Glossary\Communication\Plugin\GlossaryInstallerPlugin',
    'use Spryker\Zed\Locale\Communication\Plugin\Installer as LocaleInstallerPlugin' => 'use Spryker\Zed\Locale\Communication\Plugin\LocaleInstallerPlugin',
    'use Spryker\Zed\Newsletter\Communication\Plugin\Installer as NewsletterInstallerPlugin' => 'use Spryker\Zed\Newsletter\Communication\Plugin\NewsletterInstallerPlugin',
    'use Spryker\Zed\Price\Communication\Plugin\Installer as PriceInstallerPlugin' => 'use Spryker\Zed\Price\Communication\Plugin\PriceInstallerPlugin',
    'use Spryker\Zed\User\Communication\Plugin\Installer as UserInstallerPlugin' => 'use Spryker\Zed\User\Communication\Plugin\UserInstallerPlugin',
    'use Spryker\Zed\Ratepay\Communication\Plugin\Installer as RatepayInstallerPlugin' => 'use Spryker\Zed\Ratepay\Communication\Plugin\RatepayInstallerPlugin',
    'use Spryker\Zed\Tax\Communication\Plugin\ProductItemTaxRateCalculatorPlugin' => 'use Spryker\Zed\TaxProductConnector\Communication\Plugin\ProductItemTaxRateCalculatorPlugin',
    'use Spryker\Shared\Symfony\Plugin\ServiceProvider\DoubleSubmitProtectionServiceProvider' => 'use Spryker\Shared\Application\ServiceProvider\DoubleSubmitProtectionServiceProvider',
    'use Spryker\Shared\Collector\Code\KeyBuilder\\' => 'use Spryker\Shared\KeyBuilder\KeyBuilder\\',
    'use Spryker\Zed\Messenger\Business\Model\MessengerInterface;' => 'use Psr\Log\LoggerInterface as MessengerInterface;',
    'use Spryker\Zed\Messenger\Business\Model\MessengerInterface' => 'use Psr\Log\LoggerInterface', // <- use without colon at the end to replace without replacing a given alias
    'use Spryker\Shared\Library\BatchIterator\CountableIteratorInterface;' => 'use Spryker\Service\UtilDataReader\Model\BatchIterator\CountableIteratorInterface;',
    'use Spryker\Shared\Library\Collection\CollectionInterface;' => 'use Everon\Component\Collection\CollectionInterface;',
    'use Spryker\Shared\Library\Collection\Collection;' => 'use Everon\Component\Collection\Collection;',
    'use Spryker\Shared\Library\Collection\LazyCollection;' => 'use Everon\Component\Collection\Lazy as LazyCollection;',
    'use Spryker\Shared\Library\Environment;' => 'use Spryker\Shared\Config\Environment;',
    'use Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadInterface;' => 'use Spryker\Zed\Collector\Business\Storage\Adapter\KeyValue\ReadInterface;',
]);
$updaterCommand->addUpdater($useStatementReplace);

/**
 * Use statement which can not automatically be replaced, just output message
 */
$useFinder = new UseFinder([
    'use Spryker\\\\(?:Yves|Zed|Shared|Client)\\\\Library\\\\(?!DataDirectory)(?:.*?);',
    'Spryker\\\\Shared\\\\Library\\\\DataDirectory' => 'You need to replace the usage with e.g. APPLICATION_ROOT_DIR . \'/data/\' . Store::getInstance()->getStoreName() . \'/foo/bar\'',
    'use Spryker\\\\Zed\\\\Messenger\\\\Business\\\\Model\\\\MessengerInterface' => 'UseStatementReplace was not able to replace this use statement, maybe you use this with an alias',
    'use Pyz\\\\Yves\\\\Product\\\\Plugin\\\\TwigProductImagePlugin',
    'System::getHostname()' => 'Please use UtilNetworkService to get the hostname',
]);

$updaterCommand->addUpdater($useFinder);

$application = new Application();
$application->add($updaterCommand);
$application->run();
