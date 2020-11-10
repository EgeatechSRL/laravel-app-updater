<?php

namespace EgeaTech\AppUpdater;

use Illuminate\Support\Facades\Route;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\Http\Routing\RouteRegistrar;
use EgeaTech\AppUpdater\Http\Routing\RoutingOptions;

class AppUpdater
{
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

        // Register the new parameter binding
        Route::bind('applicationId', function (string $value): ApplicationId {
            return new ApplicationId($value);
        });

        // And all package routes
        Route::group($options->getGlobalRoutesOptions(), function($router) use ($options) {
            (new RouteRegistrar($router, $options))->all();
        });
    }
}
