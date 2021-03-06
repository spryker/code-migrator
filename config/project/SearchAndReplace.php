<?php

return [
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
    '@return \Spryker\Shared\Library\BatchIterator\CountableIteratorInterface' => '@return \Spryker\Service\UtilDataReader\Model\BatchIterator\CountableIteratorInterface',
    '@var \Spryker\Shared\Library\BatchIterator\CountableIteratorInterface' => '@var \Spryker\Service\UtilDataReader\Model\BatchIterator\CountableIteratorInterface',
    'use Spryker\Shared\Library\Collection\CollectionInterface;' => 'use Everon\Component\Collection\CollectionInterface;',
    '@var \Spryker\Shared\Library\Collection\CollectionInterface' => '@var \Everon\Component\Collection\CollectionInterface',
    '@param \Spryker\Shared\Library\Collection\CollectionInterface' => '@param \Everon\Component\Collection\CollectionInterface',
    '@return \Spryker\Shared\Library\Collection\CollectionInterface' => '@return \Everon\Component\Collection\CollectionInterface',
    'use Spryker\Shared\Library\Collection\Collection;' => 'use Everon\Component\Collection\Collection;',
    'use Spryker\Shared\Library\Collection\LazyCollection;' => 'use Everon\Component\Collection\Lazy as LazyCollection;',
    'use Spryker\Shared\Library\Environment;' => 'use Spryker\Shared\Config\Environment;',
    'use Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadInterface;' => 'use Spryker\Zed\Collector\Business\Storage\Adapter\KeyValue\ReadInterface;',
    'use ' . PROJECT_NAMESPACE . '\Yves\Application\Plugin\Pimple;' => 'use Spryker\Yves\Kernel\Plugin\Pimple;',
    'use Spryker\Yves\Application\Application;' => 'use Spryker\Yves\Kernel\Application;',
    '@return \Spryker\Yves\Application\Application' => '@return \Spryker\Yves\Kernel\Application',
    '@var \Spryker\Yves\Application\Application' => '@var \Spryker\Yves\Kernel\Application',
    '@param \Spryker\Yves\Application\Application' => '@param \Spryker\Yves\Kernel\Application',
    'use Spryker\Shared\Library\Application\Environment;' => 'use Spryker\Shared\Config\Application\Environment;',
    'use Spryker\Yves\Application\Controller\AbstractController;' => 'use Spryker\Yves\Kernel\Controller\AbstractController;',
    'use ' . PROJECT_NAMESPACE . '\Yves\Application\Plugin\Provider\FlashMessengerServiceProvider;' => 'use Spryker\Yves\Messenger\Plugin\Provider\FlashMessengerServiceProvider;',
    'use ' . PROJECT_NAMESPACE . '\Yves\Application\Business\Model\FlashMessengerInterface;' => 'use Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface;',
    '@return \\' . PROJECT_NAMESPACE . '\Yves\Application\Business\Model\FlashMessengerInterface' => '@return \Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface',
    '@var \\' . PROJECT_NAMESPACE . '\Yves\Application\Business\Model\FlashMessengerInterface' => '@var \Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface',
    '@param \\' . PROJECT_NAMESPACE . '\Yves\Application\Business\Model\FlashMessengerInterface' => '@param \Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface',
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
    'use Spryker\Zed\Console\Business\Model\Console;' => 'use Spryker\Zed\Kernel\Communication\Console\Console;',
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
    'use Spryker\Zed\Application\Communication\Console\BuildNavigationConsole;' => 'use Spryker\Zed\ZedNavigation\Communication\Console\BuildNavigationConsole;',
    'define(\'APPLICATION\', \'YVES\');' => 'use Spryker\Shared\ErrorHandler\ErrorHandlerEnvironment;' . PHP_EOL . PHP_EOL . 'define(\'APPLICATION\', \'YVES\');',
    'define(\'APPLICATION\', \'ZED\');' => 'use Spryker\Shared\ErrorHandler\ErrorHandlerEnvironment;' . PHP_EOL . PHP_EOL . 'define(\'APPLICATION\', \'ZED\');',
    '$bootstrap = new YvesBootstrap();' => '$errorHandlerEnvironment = new ErrorHandlerEnvironment();' . PHP_EOL . '$errorHandlerEnvironment->initialize();' . PHP_EOL . PHP_EOL . '$bootstrap = new YvesBootstrap();',
    '$bootstrap = new ZedBootstrap();' => '$errorHandlerEnvironment = new ErrorHandlerEnvironment();' . PHP_EOL . '$errorHandlerEnvironment->initialize();' . PHP_EOL . PHP_EOL . '$bootstrap = new ZedBootstrap();',
    'return new DateFormatterTwigExtension($this->createDateFormatter());' => 'return new DateTimeFormatterTwigExtension($this->getUtilDateTimeService());',
    'class NewRelicDependencyProvider' => 'use Spryker\Yves\Kernel\Container;' . PHP_EOL . PHP_EOL . 'class NewRelicDependencyProvider',
    'return new CsvBatchIterator($this->getFilename());' => 'return $this->utilDataReaderService->getCsvBatchIterator($this->getFilename());',
    '| formatDateShort' => '| formatDateTime',
    '|formatDateShort' => '| formatDateTime',
    'use Spryker\Shared\Url\Url;' => 'use Spryker\Service\UtilText\Model\Url\Url;',
    '{{ numberOfItems }}' => '{{ app[\'cart.quantity\'] }}',
];
