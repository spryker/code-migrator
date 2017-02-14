<?php

use Spryker\Migrator\MissingCodeFinder;

return [
    'Pyz/Yves/Application/ApplicationDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$container = $this->addUtilDateTimeService($container);',
            MissingCodeFinder::OPTION_CODE => '$container = $this->addUtilDateTimeService($container);',
        ],
    ],
    'Pyz/Zed/Application/ApplicationDependencyProvider.php' => [
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
    ],
    'Pyz/Zed/Checkout/CheckoutDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'new OmsPostSaveHookPlugin()',
            MissingCodeFinder::OPTION_CODE => 'new OmsPostSaveHookPlugin(),',
            MissingCodeFinder::OPTION_MESSAGE => 'Add this to the "getCheckoutPostHooks()" method',
        ],
    ],
    'CategoryNodeCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
    ],
    'CmsPageCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
    ],
    'ProductCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
    ],
    'AttributeMapCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
    ],
    'ProductAbstractCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
    ],
    'ProductConcreteCollector.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => 'parent::__construct($utilDataReaderService);',
            MissingCodeFinder::OPTION_CODE => 'parent::__construct($utilDataReaderService);',
        ],
    ],
    'Pyz/Zed/Collector/CollectorDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$container[self::SERVICE_DATA] = function (Container $container) {\' => ',
            MissingCodeFinder::OPTION_CODE => '$container[self::SERVICE_DATA] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};',
        ],
    ],
    'Pyz/Zed/Updater/UpdaterDependencyProvider.php' => [
        [
            MissingCodeFinder::OPTION_SEARCH => '$container[static::SERVICE_UTIL_IO] = function (Container $container) {\' => ',
            MissingCodeFinder::OPTION_CODE => '$container[static::SERVICE_UTIL_IO] = function (Container $container) {
    return $container->getLocator()->utilDataReader()->service();
};',
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
        ],
    ],
];
