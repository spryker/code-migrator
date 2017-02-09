<?php

define('PROJECT_ROOT', realpath(__DIR__ . '/../../../../'));
define('PROJECT_NAMESPACE', 'Pyz');

require_once PROJECT_ROOT . '/vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Spryker\Updater\ConstantRemoved;
use Spryker\Updater\DuplicateConfigConstant;
use Spryker\Updater\MissingCodeFinder;
use Spryker\Updater\RemoveFile;
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
    'ApplicationConstants::JENKINS_BASE_URL' => 'SetupConstants::JENKINS_BASE_URL',
    'ApplicationConstants::JENKINS_DIRECTORY' => 'SetupConstants::JENKINS_DIRECTORY',
    'ApplicationConstants::DISPLAY_ERRORS' => 'ErrorHandlerConstants::DISPLAY_ERRORS',
    'ApplicationConstants::STORE_PREFIX' => 'KernelConstants::STORE_PREFIX',
    'ApplicationConstants::ZED_TWIG_OPTIONS' => 'TwigConstants::ZED_TWIG_OPTIONS',
    'ApplicationConstants::YVES_TWIG_OPTIONS' => 'TwigConstants::YVES_TWIG_OPTIONS',
    'ApplicationConstants::NAVIGATION_CACHE_ENABLED' => 'NavigationConstants::NAVIGATION_CACHE_ENABLED',
    'ApplicationConstants::LOG_LEVEL' => 'LogConstants::LOG_LEVEL',
    'ApplicationConstants::YVES_ERROR_PAGE' => 'ErrorHandlerConstants::YVES_ERROR_PAGE',
    'ApplicationConstants::ZED_ERROR_PAGE' => 'ErrorHandlerConstants::ZED_ERROR_PAGE',
]);


/**
 * Constants removed
 */
$constantRemoved = new ConstantRemoved([
    'ApplicationConstants::TRANSFER_SSL',
    'ApplicationConstants::ALLOW_INTEGRATION_CHECKS' => 'Go to the mentioned file and remove the usage',
]);


/**
 * Replaces use statements
 */
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
    'use Pyz\Yves\Application\Plugin\Pimple;' => 'use Spryker\Yves\Kernel\Plugin\Pimple;',
    'use Spryker\Yves\Application\Controller\AbstractController;' => 'use Spryker\Yves\Kernel\Controller\AbstractController;',
    'use Pyz\Yves\Application\Plugin\Provider\FlashMessengerServiceProvider;' => 'use Spryker\Yves\Messenger\Plugin\Provider\FlashMessengerServiceProvider;',
    'use Spryker\Zed\Propel\Business\Runtime\ActiveQuery\Criteria;' => 'use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;',
]);


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



$missingCodeFinder = new MissingCodeFinder([
    'ApplicationDependencyProvider.php' => [
        'protected function addUtilDateTimeService(Container $container)' => 'protected function addUtilDateTimeService(Container $container)
{
    $container[self::SERVICE_UTIL_DATE_TIME] = function (Container $container) {
        return $container->getLocator()->utilDateTime()->service();
    };

    return $container;
}',
        'const SERVICE_UTIL_DATE_TIME = \'util date time service\';' => 'const SERVICE_UTIL_DATE_TIME = \'util date time service\';',
        '$container = $this->addUtilDateTimeService($container);' => '$container = $this->addUtilDateTimeService($container);',
    ],
]);



$duplicateConstantUpdater = new DuplicateConfigConstant([
    'ApplicationConstants::HOST_YVES' => [
        'CustomerConstants::HOST_YVES',
        'NewsletterConstants::HOST_YVES',
        'PayolutionConstants::HOST_YVES',
        'PayoneConstants::HOST_YVES',
        'ProductManagementConstants::HOST_YVES',
    ],
    'ApplicationConstants::HOST_ZED_API' => [
        'ZedRequestConstants::HOST_ZED_API'
    ],
    'ApplicationConstants::HOST_SSL_ZED_API' => [
        'ZedRequestConstants::HOST_SSL_ZED_API'
    ],
    'ApplicationConstants::YVES_THEME' => [
        'CmsConstants::YVES_THEME'
    ],
    'AuthConstants::AUTH_ZED_ENABLED' => [
        'ZedRequestConstants::AUTH_ZED_ENABLED'
    ],
]);

/**
 * Files which match fileNamePattern will be removed after user confirms
 */
$removeFile = new RemoveFile([
    'Pyz/Yves/Application/Business/Model/FlashMessengerInterface.php',
    'Pyz/Yves/Application/Plugin/Pimple.php',
    'Pyz/Yves/Application/Plugin/Provider/FlashMessengerServiceProvider.php',
    'Pyz/Yves/Product/Plugin/TwigProductImagePlugin.php',
]);

//$updaterCommand->addUpdater($constantReplace);
//$updaterCommand->addUpdater($constantRemoved);
//$updaterCommand->addUpdater($useStatementReplace);
//$updaterCommand->addUpdater($useFinder);
//$updaterCommand->addUpdater($missingCodeFinder);

//$updaterCommand->addUpdater($duplicateConstantUpdater);

$updaterCommand->addUpdater($removeFile);

$application = new Application();
$application->add($updaterCommand);
$application->run();
