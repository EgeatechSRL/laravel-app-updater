<?php

namespace EgeaTech\AppUpdater\Providers;

use Illuminate\Support\ServiceProvider;
use EgeaTech\AppUpdater\Models\Application;
use EgeaTech\AppUpdater\Services\ApplicationsService;
use EgeaTech\AppUpdater\Repositories\ApplicationRepository;
use EgeaTech\AppUpdater\Http\Resources\ApplicationResource;
use EgeaTech\AppUpdater\Http\Requests\ApplicationIndexRequest;
use EgeaTech\AppUpdater\Http\Requests\ApplicationStoreRequest;
use EgeaTech\AppUpdater\Http\Requests\ApplicationDeleteRequest;
use EgeaTech\AppUpdater\Http\Requests\ApplicationUpdateRequest;
use EgeaTech\AppUpdater\Http\Requests\LatestApplicationRequest;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use EgeaTech\AppUpdater\Http\Requests\ApplicationFileDownloadRequest;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Contracts\Repositories\ApplicationRepositoryContract;
use EgeaTech\AppUpdater\Contracts\Http\Resources\ApplicationResourceContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationIndexRequestContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationStoreRequestContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationDeleteRequestContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationUpdateRequestContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\LatestApplicationRequestContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationFileDownloadRequestContract;

class DependencyInjectionProvider extends ServiceProvider
{
    private static $_dependencyInjectionMap = [
        // Models
        ApplicationModelContract::class => Application::class,

        // JsonResources
        ApplicationResourceContract::class => ApplicationResource::class,

        // Repositories
        ApplicationRepositoryContract::class => ApplicationRepository::class,

        // Services
        ApplicationsServiceContract::class => ApplicationsService::class,

        // Requests
        ApplicationDeleteRequestContract::class => ApplicationDeleteRequest::class,
        ApplicationFileDownloadRequestContract::class => ApplicationFileDownloadRequest::class,
        ApplicationIndexRequestContract::class => ApplicationIndexRequest::class,
        ApplicationStoreRequestContract::class => ApplicationStoreRequest::class,
        ApplicationUpdateRequestContract::class => ApplicationUpdateRequest::class,
        LatestApplicationRequestContract::class => LatestApplicationRequest::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$_dependencyInjectionMap as $abstract => $concrete) {
            app()->bind($abstract, $concrete);
        }
    }
}
