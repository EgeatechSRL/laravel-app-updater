<?php

namespace EgeaTech\AppUpdater\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void routes(?\EgeaTech\AppUpdater\Http\Routing\RoutingOptions $options = null)
 * @method static void onlyRoutes(?\EgeaTech\AppUpdater\Http\Routing\RoutingOptions $options = null, ...$routes)
 * @method static void routeBindings()
 */
class AppUpdater extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'app-updater';
    }
}
