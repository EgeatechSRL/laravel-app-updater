<?php

namespace EgeaTech\AppUpdater\Http\Routing;

final class RoutingOptions
{
    private $_globalRoutesOptions;
    private $_indexRouteMiddlewares;
    private $_storeRouteMiddlewares;
    private $_updateRouteMiddlewares;
    private $_deleteRouteMiddlewares;
    private $_latestApplicationRouteMiddlewares;
    private $_downloadApplicationRouteMiddlewares;
    private $_showApplicationRouteMiddlewares;

    public function __construct(
        array $globalPackageRoutesOptions = [],
        array $indexRouteMiddlewares = [],
        array $storeRouteMiddlewares = [],
        array $updateRouteMiddlewares = [],
        array $deleteRouteMiddlewares = [],
        array $latestApplicationRouteMiddlewares = [],
        array $downloadApplicationRouteMiddlewares = [],
        array $showApplicationRouteMiddlewares = []
    ) {
        $this->_globalRoutesOptions = $globalPackageRoutesOptions;
        $this->_indexRouteMiddlewares = $indexRouteMiddlewares;
        $this->_storeRouteMiddlewares = $storeRouteMiddlewares;
        $this->_updateRouteMiddlewares = $updateRouteMiddlewares;
        $this->_deleteRouteMiddlewares = $deleteRouteMiddlewares;
        $this->_latestApplicationRouteMiddlewares = $latestApplicationRouteMiddlewares;
        $this->_downloadApplicationRouteMiddlewares = $downloadApplicationRouteMiddlewares;
        $this->_showApplicationRouteMiddlewares = $showApplicationRouteMiddlewares;
    }

    public function getGlobalRoutesOptions(): array
    {
        return $this->_globalRoutesOptions;
    }

    public function getIndexRouteMiddlewares(): array
    {
        return $this->_indexRouteMiddlewares;
    }

    public function getStoreRouteMiddlewares(): array
    {
        return $this->_storeRouteMiddlewares;
    }

    public function getUpdateRouteMiddlewares(): array
    {
        return $this->_updateRouteMiddlewares;
    }

    public function getDeleteRouteMiddlewares(): array
    {
        return $this->_deleteRouteMiddlewares;
    }

    public function getLatestApplicationRouteMiddlewares(): array
    {
        return $this->_latestApplicationRouteMiddlewares;
    }

    public function getDownloadApplicationRouteMiddlewares(): array
    {
        return $this->_downloadApplicationRouteMiddlewares;
    }

    public function getShowApplicationRouteMiddlewares(): array
    {
        return $this->_showApplicationRouteMiddlewares;
    }
}
