<?php

namespace EgeaTech\AppUpdater;

use Illuminate\Support\Facades\Route;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\Http\Routing\RouteRegistrar;
use EgeaTech\AppUpdater\Http\Routing\RoutingOptions;

class AppUpdater
{
    /**
     * Simple mapping between available routes that
     * the user can register and the appropriate
     * method to be called from the router to register
     * each of them.
     *
     * @var string[]
     */
    private static $routes = [
        'index' => 'registerIndexRoute',
        'latest' => 'registerGetLatestApplicationRoute',
        'show' => 'registerShowApplicationRoute',
        'update' => 'registerUpdateApplicationRoute',
        'store' => 'registerStoreApplicationRoute',
        'delete' => 'registerDeleteApplicationRoute',
        'download' => 'registerDownloadApplicationRoute',
    ];

    /**
     * Registers all available package routes
     *
     * @param null|RoutingOptions $options
     * @return void
     */
    public static function routes(?RoutingOptions $options = null): void
    {
        if (!$options) {
            $options = new RoutingOptions();
        }

        // Register the new parameter binding...
        self::routeBindings();

        // ...And all package routes
        Route::group($options->getGlobalRoutesOptions(), function($router) use ($options) {
            (new RouteRegistrar($router, $options))->all();
        });
    }

    /**
     * Registers the custom route parameter binding,
     * when requesting `applicationId` field
     */
    public static function routeBindings(): void
    {
        Route::bind('applicationId', function (string $value): ApplicationId {
            return new ApplicationId($value);
        });
    }

    /**
     * Register only a subset of package routes
     *
     * @param RoutingOptions|null $options
     * @param string[] $routes
     */
    public static function onlyRoutes(?RoutingOptions $options = null, ... $routes): void
    {
        if (!$options) {
            $options = new RoutingOptions();
        }

        // Register the new parameter binding..
        self::routeBindings();

        // ...And the routes chosen by the user
        Route::group($options->getGlobalRoutesOptions(), function($router) use ($options, $routes) {
            $registrarInstance = new RouteRegistrar($router, $options);

            foreach ($routes as $route) {
                $registrarInstance->{static::$routes[$route]}();
            }
        });
    }
}
