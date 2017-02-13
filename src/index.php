<?php

define('PROJECT_ROOT', realpath(__DIR__ . '/../../../../'));
define('PROJECT_NAMESPACE', 'Pyz');

require_once PROJECT_ROOT . '/vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Spryker\Updater\ClassConstantAdder;
use Spryker\Updater\ClassMethodAdder;
use Spryker\Updater\ConstantRemoved;
use Spryker\Updater\DuplicateConfigConstant;
use Spryker\Updater\MissingCodeFinder;
use Spryker\Updater\RemoveFile;
use Spryker\Updater\SearchAndRemove;
use Spryker\Updater\UseFinder;
use Spryker\Updater\SearchAndReplace;
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
    'ApplicationConstants::TRANSFER_DEBUG_SESSION_FORWARD_ENABLED' => 'ZedRequestConstants::TRANSFER_DEBUG_SESSION_FORWARD_ENABLED',
    'ApplicationConstants::TRANSFER_DEBUG_SESSION_NAME' => 'ZedRequestConstants::TRANSFER_DEBUG_SESSION_NAME',
    'ApplicationConstants::ZED_API_SSL_ENABLED' => 'ZedRequestConstants::ZED_API_SSL_ENABLED',
    'ApplicationConstants::ZED_SHOW_EXCEPTION_STACK_TRACE' => 'ErrorHandlerConstants::ERROR_RENDERER',
    'ApplicationConstants::YVES_SHOW_EXCEPTION_STACK_TRACE' => 'ErrorHandlerConstants::ERROR_RENDERER',
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
$searchAndReplace = new SearchAndReplace([
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
    'use Spryker\Zed\Application\Communication\Plugin\ServiceProvider\TwigServiceProvider as SprykerTwigServiceProvider;' => 'use Spryker\Zed\Twig\Communication\Plugin\ServiceProvider\TwigServiceProvider as SprykerTwigServiceProvider;',
    '@var \Spryker\Shared\Collector\Code\KeyBuilder\KeyBuilderInterface' => '@var \Spryker\Shared\KeyBuilder\KeyBuilderInterface',
    '@param \Spryker\Shared\Collector\Code\KeyBuilder\KeyBuilderInterface' => '@param \Spryker\Shared\KeyBuilder\KeyBuilderInterface',
    '@var \Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadInterface' => '@var \Spryker\Zed\Collector\Business\Storage\Adapter\KeyValue\ReadInterface',
    '@param \Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadInterface' => '@param \Spryker\Zed\Collector\Business\Storage\Adapter\KeyValue\ReadInterface',
    'use Spryker\Zed\Messenger\Business\Model\MessengerInterface;' => 'use Psr\Log\LoggerInterface as MessengerInterface;',
    'use Spryker\Zed\Messenger\Business\Model\MessengerInterface' => 'use Psr\Log\LoggerInterface',
    '@var \Spryker\Zed\Messenger\Business\Model\MessengerInterface' => '@var \Psr\Log\LoggerInterface',
    '@param \Spryker\Zed\Messenger\Business\Model\MessengerInterface' => '@param \Psr\Log\LoggerInterface',
    '@return \Spryker\Zed\Messenger\Business\Model\MessengerInterface' => '@return \Psr\Log\LoggerInterface',
    'use Spryker\Shared\Library\BatchIterator\CountableIteratorInterface;' => 'use Spryker\Service\UtilDataReader\Model\BatchIterator\CountableIteratorInterface;',
    '@param \Spryker\Shared\Library\BatchIterator\CountableIteratorInterface' => '@param \Spryker\Service\UtilDataReader\Model\BatchIterator\CountableIteratorInterface',
    'use Spryker\Shared\Library\Collection\CollectionInterface;' => 'use Everon\Component\Collection\CollectionInterface;',
    '@var \Spryker\Shared\Library\Collection\CollectionInterface' => '@var \Everon\Component\Collection\CollectionInterface',
    '@param \Spryker\Shared\Library\Collection\CollectionInterface' => '@param \Everon\Component\Collection\CollectionInterface',
    '@return \Spryker\Shared\Library\Collection\CollectionInterface' => '@return \Everon\Component\Collection\CollectionInterface',
    'use Spryker\Shared\Library\Collection\Collection;' => 'use Everon\Component\Collection\Collection;',
    'use Spryker\Shared\Library\Collection\LazyCollection;' => 'use Everon\Component\Collection\Lazy as LazyCollection;',
    'use Spryker\Shared\Library\Environment;' => 'use Spryker\Shared\Config\Environment;',
    'use Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadInterface;' => 'use Spryker\Zed\Collector\Business\Storage\Adapter\KeyValue\ReadInterface;',
    'use Pyz\Yves\Application\Plugin\Pimple;' => 'use Spryker\Yves\Kernel\Plugin\Pimple;',
    'use Spryker\Yves\Application\Application;' => 'use Spryker\Yves\Kernel\Application;',
    '@return \Spryker\Yves\Application\Application' => '@return \Spryker\Yves\Kernel\Application',
    '@var \Spryker\Yves\Application\Application' => '@var \Spryker\Yves\Kernel\Application',
    '@param \Spryker\Yves\Application\Application' => '@param \Spryker\Yves\Kernel\Application',
    'use Spryker\Shared\Library\Application\Environment;' => 'use Spryker\Shared\Config\Application\Environment;',
    'use Spryker\Yves\Application\Controller\AbstractController;' => 'use Spryker\Yves\Kernel\Controller\AbstractController;',
    'use Pyz\Yves\Application\Plugin\Provider\FlashMessengerServiceProvider;' => 'use Spryker\Yves\Messenger\Plugin\Provider\FlashMessengerServiceProvider;',
    'use Pyz\Yves\Application\Business\Model\FlashMessengerInterface;' => 'use Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface;',
    '@return \Pyz\Yves\Application\Business\Model\FlashMessengerInterface' => '@return \Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface',
    'use Spryker\Zed\Propel\Business\Runtime\ActiveQuery\Criteria;' => 'use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;',
    'use Spryker\Shared\Library\Twig\DateFormatterTwigExtension;' => 'use Spryker\Service\UtilDateTime\Model\DateTimeFormatterTwigExtension;',
    '@return \Spryker\Shared\Library\Twig\DateFormatterTwigExtension' => '@return \Spryker\Service\UtilDateTime\Model\DateTimeFormatterTwigExtension',
    'public function createDateFormatter()' => 'protected function getUtilDateTimeService()',
    'return new DateFormatter(Context::getInstance());' => 'return $this->getProvidedDependency(ApplicationDependencyProvider::SERVICE_UTIL_DATE_TIME);',
    'foreach ($client->getZedErrorMessages() as $errorMessage) {' => 'foreach ($client->getZedStub()->getErrorMessages() as $errorMessage) {',
    '$this->flashMessenger->addErrorMessage($errorMessage->getMessage());' => '$this->flashMessenger->addErrorMessage($errorMessage->getValue());',
    'foreach ($client->getZedSuccessMessages() as $successMessage) {' => 'foreach ($client->getZedStub()->getSuccessMessages() as $successMessage) {',
    '$this->flashMessenger->addSuccessMessage($successMessage->getMessage());' => '$this->flashMessenger->addSuccessMessage($successMessage->getValue());',
    'foreach ($client->getZedInfoMessages() as $infoMessage) {' => 'foreach ($client->getZedStub()->getInfoMessages() as $infoMessage) {',
    '$this->flashMessenger->addInfoMessage($infoMessage->getMessage());' => '$this->flashMessenger->addInfoMessage($infoMessage->getValue());',
    'use Spryker\Shared\Transfer\AbstractTransfer;' => 'use Spryker\Shared\Kernel\Transfer\AbstractTransfer;',
    '@param \Spryker\Shared\Transfer\AbstractTransfer' => '@param \Spryker\Shared\Kernel\Transfer\AbstractTransfer',
    '@var \Spryker\Shared\Transfer\AbstractTransfer' => '@var \Spryker\Shared\Kernel\Transfer\AbstractTransfer',
    '@return \Spryker\Shared\Transfer\AbstractTransfer' => '@return \Spryker\Shared\Kernel\Transfer\AbstractTransfer',
    'use Spryker\Shared\Collector\Code\KeyBuilder\KeyBuilderInterface;' => 'use Spryker\Shared\KeyBuilder\KeyBuilderInterface;',
    'use Spryker\Shared\NewRelic\Api;' => 'use Spryker\Shared\NewRelicApi\NewRelicApi;',
    '@return \Spryker\Shared\NewRelic\ApiInterface' => '@return \Spryker\Shared\NewRelicApi\NewRelicApiInterface',
    'use Spryker\Shared\Library\BatchIterator\XmlBatchIterator;' => 'use Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIterator;',
    '@var \Spryker\Shared\Library\BatchIterator\XmlBatchIterator' => '@var \Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIterator',
    '@param \Spryker\Shared\Library\BatchIterator\XmlBatchIterator' => '@param \Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIterator',
    '@return \Spryker\Shared\Library\BatchIterator\XmlBatchIterator' => '@return \Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIterator',
    'use Spryker\Shared\Library\BatchIterator\XmlBatchIteratorInterface;' => 'use Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIteratorInterface;',
    '@var \Spryker\Shared\Library\BatchIterator\XmlBatchIteratorInterface' => '@var \Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIteratorInterface',
    '@param \Spryker\Shared\Library\BatchIterator\XmlBatchIteratorInterface' => '@param \Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIteratorInterface',
    '@return \Spryker\Shared\Library\BatchIterator\XmlBatchIteratorInterface' => '@return \Spryker\Service\UtilDataReader\Model\BatchIterator\XmlBatchIteratorInterface',
    'return new Api();' => 'return new NewRelicApi();',
    '$host = $request->server->get(\'COMPUTERNAME\', System::getHostname());' => '$host = $request->server->get(\'COMPUTERNAME\', $this->getFactory()->getUtilNetworkService()->getHostname());',
    '@return \Spryker\Zed\Kernel\Communication\Plugin\GatewayServiceProviderPlugin' => '@return \Spryker\Zed\ZedRequest\Communication\Plugin\GatewayServiceProviderPlugin',
    'use Spryker\Zed\Tax\Communication\Plugin\ProductItemTaxRateCalculatorPlugin;' => 'use Spryker\Zed\TaxProductConnector\Communication\Plugin\ProductItemTaxRateCalculatorPlugin;',
    'use Spryker\Zed\Console\Business\Model\Console as SprykerConsole;' => 'use Spryker\Zed\Kernel\Communication\Console\Console as SprykerConsole;',
    'use Spryker\Zed\Propel\Communication\Plugin\Connection;' => 'use Propel\Runtime\Propel;',
    'return (new Connection())->get();' => 'return Propel::getConnection();',
    '@return \Spryker\Zed\Installer\Communication\Plugin\AbstractInstallerPlugin' => '@return \Spryker\Zed\Installer\Dependency\Plugin\InstallerPluginInterface',
    'use Spryker\Shared\Library\Reader\Csv\CsvReaderInterface;' => 'use Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReaderInterface;',
    'use Spryker\Shared\Library\Reader\Csv\CsvReader;' => 'use Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReader;',
    '@var \Spryker\Shared\Library\Reader\Csv\CsvReader' => '@var \Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReader',
    '@param \Spryker\Shared\Library\Reader\Csv\CsvReader' => '@param \Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReader',
    '@return \Spryker\Shared\Library\Reader\Csv\CsvReader' => '@return \Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReader',
    '@var \Spryker\Shared\Library\Reader\Csv\CsvReaderInterface' => '@var \Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReaderInterface',
    '@param \Spryker\Shared\Library\Reader\Csv\CsvReaderInterface' => '@param \Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReaderInterface',
    '@return \Spryker\Shared\Library\Reader\Csv\CsvReaderInterface' => '@return \Spryker\Service\UtilDataReader\Model\Reader\Csv\CsvReaderInterface',
    '$this->csvReader->load($this->dataDirectory . \'/stocks.csv\');' => 'if (!$this->csvReader) {' . PHP_EOL . '            $this->csvReader = $this->utilDataReaderService->getCsvReader()->load($this->dataDirectory . \'/stocks.csv\');' . PHP_EOL . '    }',
    'CsvReader $csvReader,' => 'UtilDataReaderServiceInterface $utilDataReaderService,',
    '$this->csvReader = $csvReader;' => '$this->utilDataReaderService = $utilDataReaderService;',
    'return new CsvBatchIterator($this->getCsvDataFilename());' => 'return $this->utilDataReaderService->getCsvBatchIterator($this->getCsvDataFilename());',
    'use Spryker\Shared\Library\BatchIterator\CsvBatchIterator;' => 'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    '$this->createCsvFileReader()' => '$this->getUtilDataReaderService()',
    'public function createCsvFileReader()' => 'public function getUtilDataReaderService()',
    'return new CsvReader();' => 'return $this->getProvidedDependency(UpdaterDependencyProvider::SERVICE_UTIL_IO);',
    'use Spryker\Zed\Application\Communication\Controller\AbstractController;' => 'use Spryker\Zed\Kernel\Communication\Controller\AbstractController;',
    'parent::__construct($importerCollection, $dataDirectory);' => 'parent::__construct($utilDataReaderService, $importerCollection, $dataDirectory);',
    'public function __construct(array $importerCollection, $dataDirectory' => 'public function __construct(UtilDataReaderServiceInterface $utilDataReaderService, array $importerCollection, $dataDirectory',
    'use Spryker\Shared\Library\DataDirectory;' => 'use Spryker\Shared\Kernel\Store;',
    'DataDirectory::getLocalStoreSpecificPath(\'cache/Zed/twig\')' => 'APPLICATION_ROOT_DIR . \'/data/\' . Store::getInstance()->getStoreName() . \'/cache/Zed/twig\'',
    'DataDirectory::getLocalStoreSpecificPath(\'cache/Yves/twig\')' => 'APPLICATION_ROOT_DIR . \'/data/\' . Store::getInstance()->getStoreName() . \'/cache/Yves/twig\'',
    'DataDirectory::getLocalStoreSpecificPath(\'cache/profiler\')' => 'APPLICATION_ROOT_DIR . \'/data/\' . Store::getInstance()->getStoreName() . \'/cache/profiler\'',
    '@return \Spryker\Shared\Library\DateFormatter' => '@return \Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface',
    'use Spryker\Shared\Library\Application\Environment as ApplicationEnvironment;' => 'use Spryker\Shared\Config\Application\Environment as ApplicationEnvironment;',
    '$config[ErrorHandlerConstants::ERROR_RENDERER] = true;' => '$config[ErrorHandlerConstants::ERROR_RENDERER] = WebHtmlErrorRenderer::class;',
    '$config[ErrorHandlerConstants::ERROR_RENDERER] = false;' => '$config[ErrorHandlerConstants::ERROR_RENDERER] = WebExceptionErrorRenderer::class;',
    'use Spryker\Zed\Kernel\Communication\Plugin\GatewayControllerListenerPlugin;' => 'use Spryker\Zed\ZedRequest\Communication\Plugin\GatewayControllerListenerPlugin;',
    'use Spryker\Zed\Kernel\Communication\Plugin\GatewayServiceProviderPlugin;' => 'use Spryker\Zed\ZedRequest\Communication\Plugin\GatewayServiceProviderPlugin;',
    'use Spryker\Zed\Application\Communication\Console\BuildNavigationConsole;' => 'use Spryker\Zed\Navigation\Communication\Console\BuildNavigationConsole;',
    'namespace Pyz\Zed\Application\Communication;' => 'namespace Pyz\Zed\Application\Communication;' .  PHP_EOL .  PHP_EOL . 'use Spryker\Shared\Auth\AuthConstants;' . PHP_EOL . 'use Spryker\Shared\Config\Config;',
    'define(\'APPLICATION\', \'YVES\');' => 'use Spryker\Shared\ErrorHandler\ErrorHandlerEnvironment;' . PHP_EOL . PHP_EOL . 'define(\'APPLICATION\', \'YVES\');',
    'define(\'APPLICATION\', \'ZED\');' => 'use Spryker\Shared\ErrorHandler\ErrorHandlerEnvironment;' . PHP_EOL . PHP_EOL . 'define(\'APPLICATION\', \'ZED\');',
    '$bootstrap = new YvesBootstrap();' => '$errorHandlerEnvironment = new ErrorHandlerEnvironment();' . PHP_EOL . '$errorHandlerEnvironment->initialize();' . PHP_EOL . PHP_EOL . '$bootstrap = new YvesBootstrap();',
    '$bootstrap = new ZedBootstrap();' => '$errorHandlerEnvironment = new ErrorHandlerEnvironment();' . PHP_EOL . '$errorHandlerEnvironment->initialize();' . PHP_EOL . PHP_EOL . '$bootstrap = new ZedBootstrap();',
    'return new DateFormatterTwigExtension($this->createDateFormatter());' => 'return new DateTimeFormatterTwigExtension($this->getUtilDateTimeService());',
    'class NewRelicDependencyProvider' => 'use Spryker\Yves\Kernel\Container;' . PHP_EOL . PHP_EOL . 'class NewRelicDependencyProvider',
]);


$searchAndRemove = new SearchAndRemove([
    'new ApplicationIntegrationCheckConsole\(\),',
    'use Spryker\Shared\Library\System;',
    'use Spryker\Shared\Library\Context;',
    'use Spryker\Shared\Library\DateFormatter;',
    'use Spryker\Shared\Library\DataDirectory;',
    '$config[ApplicationConstants::ALLOW_INTEGRATION_CHECKS] = true;',
    '$config[ApplicationConstants::ALLOW_INTEGRATION_CHECKS] = false;',
    '$config[ApplicationConstants::TRANSFER_SSL] = false;',
    '$config[ApplicationConstants::TRANSFER_SSL] = true;',
    '$this->application->register(new MonologServiceProvider());',
]);


/**
 * Use statement which can not automatically be replaced, just output message
 */
$useFinder = new UseFinder([
    'use Spryker\\\\(?:Yves|Zed|Shared|Client)\\\\Library\\\\(?!DataDirectory)(?:.*?);',
    'Spryker\\\\Shared\\\\Library\\\\DataDirectory' => 'You need to replace the usage with e.g. APPLICATION_ROOT_DIR . \'/data/\' . Store::getInstance()->getStoreName() . \'/foo/bar\'',
    'use Spryker\\\\Zed\\\\Messenger\\\\Business\\\\Model\\\\MessengerInterface' => 'UseStatementReplace was not able to replace this use statement, maybe you use this with an alias',
    'use Pyz\\\\Yves\\\\Product\\\\Plugin\\\\TwigProductImagePlugin',
    'public function getCheckSteps\(' => 'You can remove this method, use proper CI for testing',
    'System::getHostname()' => 'Please use UtilNetworkService::getHostName() instead',
]);


$missingCodeFinder = new MissingCodeFinder([
    'Pyz/Yves/Application/ApplicationDependencyProvider.php' => [
        '$container = $this->addUtilDateTimeService($container);' => '$container = $this->addUtilDateTimeService($container);',
    ],
    'Pyz/Zed/Application/ApplicationDependencyProvider.php' => [
        'new RedirectAfterLoginProvider()' => 'new RedirectAfterLoginProvider()',
        'new GuiTwigExtensionServiceProvider()' => 'new GuiTwigExtensionServiceProvider()',
        'new DateTimeFormatterServiceProvider()' => 'new DateTimeFormatterServiceProvider()',
        'new TranslationServiceProvider()' => 'new TranslationServiceProvider()',
        'new NewRelicRequestTransactionServiceProvider()' => 'new NewRelicRequestTransactionServiceProvider()',
        'new NavigationServiceProvider()' => 'new NavigationServiceProvider()',
        'new PropelServiceProvider()' => 'new PropelServiceProvider()',
    ],
    'Pyz/Zed/Checkout/CheckoutDependencyProvider.php' => [
        'new OmsPostSaveHookPlugin()' => 'new OmsPostSaveHookPlugin()',
    ],
    'CategoryNodeCollector.php' => [
        'parent::__construct($utilDataReaderService);' => 'parent::__construct($utilDataReaderService);',
    ],
    'CmsPageCollector.php' => [
        'parent::__construct($utilDataReaderService);' => 'parent::__construct($utilDataReaderService);',
    ],
    'ProductCollector.php' => [
        'parent::__construct($utilDataReaderService);' => 'parent::__construct($utilDataReaderService);',
    ],
    'AttributeMapCollector.php' => [
        'parent::__construct($utilDataReaderService);' => 'parent::__construct($utilDataReaderService);',
    ],
    'ProductAbstractCollector.php' => [
        'parent::__construct($utilDataReaderService);' => 'parent::__construct($utilDataReaderService);',
    ],
    'ProductConcreteCollector.php' => [
        'parent::__construct($utilDataReaderService);' => 'parent::__construct($utilDataReaderService);',
    ],
    'Pyz/Zed/Collector/CollectorDependencyProvider.php' => [
        '$container[self::SERVICE_DATA] = function (Container $container) {' => '
$container[self::SERVICE_DATA] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};
        ',
    ],
    'Pyz/Zed/Updater/UpdaterDependencyProvider.php' => [
        '$container[static::SERVICE_UTIL_IO] = function (Container $container) {' => '
$container[static::SERVICE_UTIL_IO] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};
        ',
    ],
    'ProductStockUpdater.php' => [
        'protected $utilDataReaderService;' => '    /**
     * @var \Spryker\Service\UtilDataReader\UtilDataReaderService
     */
    protected $utilDataReaderService;',
    ],
    'ImporterDependencyProvider.php' => [
        '$container[static::SERVICE_DATA] = function (Container $container) {' => '
$container[static::SERVICE_DATA] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};
        ',
    ],
]);

$constantAdder = new ClassConstantAdder([
    'ImporterDependencyProvider.php' => [
        'const SERVICE_DATA = \'util data service\';'
    ],
    'UpdaterDependencyProvider.php' => [
        'const SERVICE_UTIL_IO = \'util io service\';',
    ],
    'CollectorDependencyProvider.php' => [
        'const SERVICE_DATA = \'util data service\';',
    ],
    'NewRelicDependencyProvider.php' => [
        'const SERVICE_NETWORK = \'util network service\';',
    ],
    'ApplicationDependencyProvider.php' => [
        'const SERVICE_UTIL_DATE_TIME = \'util date time service\';'
    ],
]);

$methodAdder = new ClassMethodAdder([
    'Zed/Importer/Business/Factory/InstallerFactory.php' => [
        'protected function getUtilDataReaderService()' => '    /**
     * @return \Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface
     */
    protected function getUtilDataReaderService()
    {
        return $this->getProvidedDependency(ImporterDependencyProvider::SERVICE_DATA);
    }',
    ],
    'ConsoleDependencyProvider.php' => [
        'protected function getEventSubscriber(Container $container)' => '    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Symfony\Component\EventDispatcher\EventSubscriberInterface[]
     */
    protected function getEventSubscriber(Container $container)
    {
        return [
            $this->createNewRelicConsolePlugin()
        ];
    }',
        'protected function createNewRelicConsolePlugin()' => '    /**
     * @return \Spryker\Zed\NewRelic\Communication\Plugin\NewRelicConsolePlugin
     */
    protected function createNewRelicConsolePlugin()
    {
        return new NewRelicConsolePlugin();
    }',
    ],
    'CollectorBusinessFactory.php' => [
        'protected function getUtilDataReaderService()' => '    /**
     * @return \Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface
     */
    protected function getUtilDataReaderService()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::SERVICE_DATA);
    }',
    ],
    'ZedBootstrap.php' => [
        'protected function isAuthenticationEnabled()' => '    /**
     * @return bool
     */
    protected function isAuthenticationEnabled()
    {
        return Config::get(AuthConstants::AUTH_ZED_ENABLED, true);
    }',
    ],
    'NewRelicFactory.php' => [
        'public function getUtilNetworkService()' => '    /**
     * @return \Spryker\Service\UtilNetwork\UtilNetworkServiceInterface
     */
    public function getUtilNetworkService()
    {
        return $this->getProvidedDependency(NewRelicDependencyProvider::SERVICE_NETWORK);
    }'
    ],
    'NewRelicDependencyProvider.php' => [
        'return $container->getLocator()->utilNetwork()->service();' => '    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container[self::SERVICE_NETWORK] = function (Container $container) {
            return $container->getLocator()->utilNetwork()->service();
        };

        return $container;
    }'
    ],
    'CmsController.php' => [
        'protected function renderView($viewPath, array $parameters = [])' => '    /**
     * @param string $viewPath
     * @param array $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderView($viewPath, array $parameters = [])
    {
        return $this->getApplication()->render($viewPath, $parameters);
    }'
    ],
    'Pyz/Yves/Application/ApplicationDependencyProvider.php' => [
        'protected function addUtilDateTimeService(Container $container)' => '    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addUtilDateTimeService(Container $container)
    {
        $container[self::SERVICE_UTIL_DATE_TIME] = function (Container $container) {
            return $container->getLocator()->utilDateTime()->service();
        };

        return $container;
    }'
    ],
]);
$updaterCommand->addUpdater($methodAdder);

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

$updaterCommand->addUpdater($constantAdder);

/**
 * Files which match fileNamePattern will be removed after user confirms
 */
$removeFile = new RemoveFile([
    'Pyz/Yves/Application/Business/Model/FlashMessengerInterface.php',
    'Pyz/Yves/Application/Plugin/Pimple.php',
    'Pyz/Yves/Application/Plugin/Provider/FlashMessengerServiceProvider.php',
    'Pyz/Yves/Product/Plugin/TwigProductImagePlugin.php',
]);

$updaterCommand->addUpdater($constantReplace);
$updaterCommand->addUpdater($constantRemoved);
$updaterCommand->addUpdater($searchAndReplace);
$updaterCommand->addUpdater($searchAndRemove);
$updaterCommand->addUpdater($useFinder);
$updaterCommand->addUpdater($missingCodeFinder);

$updaterCommand->addUpdater($duplicateConstantUpdater);

$updaterCommand->addUpdater($removeFile);

$application = new Application();
$application->add($updaterCommand);
$application->run();
