<?php

return [
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
];
