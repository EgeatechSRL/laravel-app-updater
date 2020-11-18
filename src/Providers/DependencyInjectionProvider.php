<?php

namespace EgeaTech\AppUpdater\Providers;

use Illuminate\Support\ServiceProvider;

use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use EgeaTech\AppUpdater\Models\Application;

use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Services\ApplicationsService;

use EgeaTech\AppUpdater\Contracts\Repositories\ApplicationRepositoryContract;
use EgeaTech\AppUpdater\Repositories\ApplicationRepository;

use EgeaTech\AppUpdater\Contracts\Http\Resources\ApplicationResourceContract;
use EgeaTech\AppUpdater\Http\Resources\ApplicationResource;

use EgeaTech\AppUpdater\Http\Requests\{
    ApplicationShowRequest,
    ApplicationIndexRequest,
    ApplicationStoreRequest,
    ApplicationDeleteRequest,
    ApplicationUpdateRequest,
    LatestApplicationRequest,
    ApplicationFileDownloadRequest,
};

use EgeaTech\AppUpdater\Contracts\Http\Requests\{
    ApplicationShowRequestContract,
    ApplicationIndexRequestContract,
    ApplicationStoreRequestContract,
    ApplicationDeleteRequestContract,
    ApplicationUpdateRequestContract,
    LatestApplicationRequestContract,
    ApplicationFileDownloadRequestContract,
};

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
        ApplicationShowRequestContract::class => ApplicationShowRequest::class,
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
