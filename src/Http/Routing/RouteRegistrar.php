<?php

namespace EgeaTech\AppUpdater\Http\Routing;

use Illuminate\Contracts\Routing\Registrar as Router;
use EgeaTech\AppUpdater\Http\Controllers\{ApplicationIndexController,
    ApplicationShowController,
    ApplicationStoreController,
    LatestApplicationController,
    ApplicationUpdateController,
    DownloadApplicationFileController,
    ApplicationDeleteController
};

class RouteRegistrar
{
    protected $router;
    protected $routeOptions;

    public function __construct(Router $router, RoutingOptions $routeOptions)
    {
        $this->router = $router;
        $this->routeOptions = $routeOptions;
    }

    /**
     * Register package routes
     *
     * @return void
     */
    public function all(): void
    {
        $this->registerIndexRoute();

        $this->registerStoreApplicationRoute();

        $this->registerGetLatestApplicationRoute();

        $this->registerShowApplicationRoute();

        $this->registerUpdateApplicationRoute();

        $this->registerDownloadApplicationRoute();

        $this->registerDeleteApplicationRoute();
    }

    public function registerIndexRoute(): void
    {
        $this->router
            ->get(
                '/applications',
                [
                    'uses' => ApplicationIndexController::class,
                    'as' => 'app-updater.application-index',
                ]
            )
            ->middleware($this->routeOptions->getIndexRouteMiddlewares());
    }

    public function registerGetLatestApplicationRoute(): void
    {
        $this->router
            ->get(
                '/applications/latest',
                [
                    'uses' => LatestApplicationController::class,
                    'as' => 'app-updater.latest-application',
                ]
            )
            ->middleware(
                array_merge(
                    ['bindings'],
                    $this->routeOptions->getLatestApplicationRouteMiddlewares()
                )
            );
    }

    public function registerShowApplicationRoute(): void
    {
        $this->router
            ->get(
                '/applications/{applicationId}',
                [
                    'uses' => ApplicationShowController::class,
                    'as' => 'app-updater.application-show',
                ]
            )
            ->middleware(
                array_merge(
                    ['bindings'],
                    $this->routeOptions->getShowApplicationRouteMiddlewares()
                )
            );
    }

    public function registerUpdateApplicationRoute(): void
    {
        $this->router
            ->patch(
                '/applications/{applicationId}',
                [
                    'uses' => ApplicationUpdateController::class,
                    'as' => 'app-updater.application-update',
                ]
            )
            ->middleware(
                array_merge(
                    ['bindings'],
                    $this->routeOptions->getUpdateRouteMiddlewares()
                )
            );
    }

    public function registerDownloadApplicationRoute(): void
    {
        $this->router
            ->get(
                '/applications/{applicationId}/download',
                [
                    'uses' => DownloadApplicationFileController::class,
                    'as' => 'app-updater.application-download',
                ]
            )
            ->middleware(
                array_merge(
                    ['bindings'],
                    $this->routeOptions->getDownloadApplicationRouteMiddlewares()
                )
            );
    }

    public function registerStoreApplicationRoute(): void
    {
        $this->router
            ->post(
                '/applications',
                [
                    'uses' => ApplicationStoreController::class,
                    'as' => 'app-updater.application-store',
                ]
            )
            ->middleware($this->routeOptions->getStoreRouteMiddlewares());
    }

    public function registerDeleteApplicationRoute(): void
    {
        $this->router
            ->delete(
                '/applications/{applicationId}',
                [
                    'uses' => ApplicationDeleteController::class,
                    'as' => 'app-updater.application-delete',
                ]
            )
            ->middleware(
                array_merge(
                    ['bindings'],
                    $this->routeOptions->getDeleteRouteMiddlewares()
                )
            );
    }
}
