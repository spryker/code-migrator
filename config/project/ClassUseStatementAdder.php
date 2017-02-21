<?php

return [
    'Zed/Application/ApplicationDependencyProvider.php' => [
        'use Spryker\Service\UtilDateTime\ServiceProvider\DateTimeFormatterServiceProvider;',
        'use Spryker\Zed\Auth\Communication\Plugin\ServiceProvider\RedirectAfterLoginProvider;',
        'use Spryker\Zed\Gui\Communication\Plugin\ServiceProvider\GuiTwigExtensionServiceProvider;',
        'use Spryker\Zed\ZedNavigation\Communication\Plugin\ServiceProvider\ZedNavigationServiceProvider;',
        'use Spryker\Zed\NewRelic\Communication\Plugin\ServiceProvider\NewRelicRequestTransactionServiceProvider;',
        'use Spryker\Zed\Application\Communication\Plugin\ServiceProvider\TranslationServiceProvider;',
        'use Spryker\Zed\Messenger\Communication\Plugin\ServiceProvider\MessengerServiceProvider;',
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
    'Zed/Console/ConsoleDependencyProvider.php' => [
        'use Spryker\Zed\NewRelic\Communication\Plugin\NewRelicConsolePlugin;',
    ],
    'Zed/Importer/Business/Factory/InstallerFactory.php' => [
        'use ' . PROJECT_NAMESPACE . '\Zed\Importer\ImporterDependencyProvider;',
    ],
    'Zed/Importer/Business/Installer/AbstractInstaller.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Updater/Business/Updater/Product/ProductStockUpdater.php' => [
        'use Spryker\Service\UtilDataReader\UtilDataReaderServiceInterface;',
    ],
    'Zed/Application/Communication/ZedBootstrap.php' => [
        'use Spryker\Shared\Config\Config;',
        'use Spryker\Shared\Auth\AuthConstants;',
    ],
];
