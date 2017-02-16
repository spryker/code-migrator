<?php

use Spryker\Migrator\MissingCodeFinder;

return [
    'Yves/Application/ApplicationDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$container = $this->addUtilDateTimeService($container);',
            MissingCodeFinder::OPTION_CODE => '$container = $this->addUtilDateTimeService($container);',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this code in your "provideDependencies()" method',
        ],
    ],
    'Zed/Application/ApplicationDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'new RedirectAfterLoginProvider()',
            MissingCodeFinder::OPTION_CODE => 'new RedirectAfterLoginProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'new GuiTwigExtensionServiceProvider()',
            MissingCodeFinder::OPTION_CODE => 'new GuiTwigExtensionServiceProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'new DateTimeFormatterServiceProvider()',
            MissingCodeFinder::OPTION_CODE => 'new DateTimeFormatterServiceProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'new TranslationServiceProvider()',
            MissingCodeFinder::OPTION_CODE => 'new TranslationServiceProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'new NewRelicRequestTransactionServiceProvider()',
            MissingCodeFinder::OPTION_CODE => 'new NewRelicRequestTransactionServiceProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'new NavigationServiceProvider()',
            MissingCodeFinder::OPTION_CODE => 'new NavigationServiceProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'new PropelServiceProvider()',
            MissingCodeFinder::OPTION_CODE => 'new PropelServiceProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'new MessengerServiceProvider()',
            MissingCodeFinder::OPTION_CODE => 'new MessengerServiceProvider(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getServiceProvider()" method',
        ],
    ],
    'Zed/Checkout/CheckoutDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'new OmsPostSaveHookPlugin()',
            MissingCodeFinder::OPTION_CODE => 'new OmsPostSaveHookPlugin(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getCheckoutPostHooks()" method',
        ],
    ],
    'Zed/Collector/Business/Search/CategoryNodeCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_CODE => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your constructor and make sure the factory injects it',
        ],
    ],
    'CmsPageCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_CODE => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your constructor and make sure the factory injects it',
        ],
    ],
    'ProductCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_CODE => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your constructor and make sure the factory injects it',
        ],
    ],
    'AttributeMapCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_CODE => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your constructor and make sure the factory injects it',
        ],
    ],
    'ProductAbstractCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_CODE => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your constructor and make sure the factory injects it',
        ],
    ],
    'ProductConcreteCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_CODE => 'UtilDataReaderServiceInterface $utilDataReaderService,',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your constructor and make sure the factory injects it',
        ],
    ],
    'Zed/Collector/CollectorDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$container[static::SERVICE_DATA] = function (Container $container) {',
            MissingCodeFinder::OPTION_CODE => '$container[static::SERVICE_DATA] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your "provideBusinessLayerDependencies()" method'
        ],
    ],
    'Zed/Updater/UpdaterDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$container[static::SERVICE_UTIL_IO] = function (Container $container) {',
            MissingCodeFinder::OPTION_CODE => '$container[static::SERVICE_UTIL_IO] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your "provideBusinessLayerDependencies()" method'
        ],
    ],
    'ProductStockUpdater.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'protected $utilDataReaderService;',
            MissingCodeFinder::OPTION_CODE => '    /**
     * @var \Spryker\Service\UtilDataReader\UtilDataReaderService
     */
    protected $utilDataReaderService;',
        ],
    ],
    'ImporterDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$container[static::SERVICE_DATA] = function (Container $container) {',
            MissingCodeFinder::OPTION_CODE => '
$container[static::SERVICE_DATA] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to your "provideBusinessLayerDependencies()" method'
        ],
    ],
    'Zed/Importer/Business/Factory/InstallerFactory.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$this->getUtilDataReaderService(),',
            MissingCodeFinder::OPTION_CODE => '$this->getUtilDataReaderService(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to all installer in this class'
        ],
    ],
    'Zed/Importer/Business/Installer/AbstractInstaller.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$this->utilDataReaderService = $utilDataReaderService;',
            MissingCodeFinder::OPTION_CODE => '$this->utilDataReaderService = $utilDataReaderService;',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the constructor of this class'
        ],
        [
            MissingCodeFinder::OPTION_SEARCH => 'protected $utilDataReaderService;',
            MissingCodeFinder::OPTION_CODE => '    /**
     * @var \Spryker\Service\UtilDataReader\UtilDataReaderService
     */
    protected $utilDataReaderService;',
        ],
    ],
];
