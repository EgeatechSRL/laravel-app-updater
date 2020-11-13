<?php

namespace EgeaTech\AppUpdater\Http\Routing;

use Illuminate\Contracts\Routing\Registrar as Router;
use EgeaTech\AppUpdater\Http\Controllers\{
    ApplicationIndexController,
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
    public function all()
    {
        $this->router
            ->group(['middleware' => ['bindings']], function(Router $router) {

                $router->get(
                    '/applications',
                    [
                        'uses' => ApplicationIndexController::class,
                        'as' => 'app-updater.application-index',
                    ]
                )
                ->middleware($this->routeOptions->getIndexRouteMiddlewares());

                $router->get(
                    '/applications/latest',
                    [
                        'uses' => LatestApplicationController::class,
                        'as' => 'app-updater.latest-application',
                    ]
                )
                ->middleware($this->routeOptions->getLatestApplicationRouteMiddlewares());

                $router->delete(
                    '/applications/{applicationId}',
                    [
                        'uses' => ApplicationDeleteController::class,
                        'as' => 'app-updater.application-delete',
                    ]
                )
                ->middleware($this->routeOptions->getDeleteRouteMiddlewares());

                $router->post(
                    '/applications',
                    [
                        'uses' => ApplicationStoreController::class,
                        'as' => 'app-updater.application-store',
                    ]
                )
                ->middleware($this->routeOptions->getStoreRouteMiddlewares());

                $router->patch(
                    '/applications/{applicationId}',
                    [
                        'uses' => ApplicationUpdateController::class,
                        'as' => 'app-updater.application-update',
                    ]
                )
                ->middleware($this->routeOptions->getUpdateRouteMiddlewares());

                $router->get(
                    '/applications/{applicationId}/download',
                    [
                        'uses' => DownloadApplicationFileController::class,
                        'as' => 'app-updater.application-download',
                    ]
                )
                ->middleware($this->routeOptions->getDownloadApplicationRouteMiddlewares());

            });
    }
}
