<?php

return [
    'Zed/Application/ApplicationDependencyProvider.php' => [
        'use Spryker\Service\UtilDateTime\ServiceProvider\DateTimeFormatterServiceProvider;',
        'use Spryker\Zed\Auth\Communication\Plugin\ServiceProvider\RedirectAfterLoginProvider;',
        'use Spryker\Zed\Gui\Communication\Plugin\ServiceProvider\GuiTwigExtensionServiceProvider;',
        'use Spryker\Zed\Navigation\Communication\Plugin\ServiceProvider\NavigationServiceProvider;',
        'use Spryker\Zed\NewRelic\Communication\Plugin\ServiceProvider\NewRelicRequestTransactionServiceProvider;',
        'use Spryker\Zed\Application\Communication\Plugin\ServiceProvider\TranslationServiceProvider;',
    ],
    'Zed/Collector/Business/Storage/ProductConcreteCollector.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Collector/Business/Storage/ProductAbstractCollector.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Collector/Business/Storage/AttributeMapCollector.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Collector/Business/Search/ProductCollector.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Collector/Business/Search/CmsPageCollector.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Collector/Business/Search/CategoryNodeCollector.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Checkout/CheckoutDependencyProvider.php' => [
        'use Spryker\Zed\Oms\Communication\Plugin\Checkout\OmsPostSaveHookPlugin;',
    ],
];
