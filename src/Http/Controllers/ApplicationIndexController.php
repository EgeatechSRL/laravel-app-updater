<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationIndexRequestContract;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class ApplicationIndexController extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        ResolvesJsonResource;

    private $_applicationService;

    public function __construct(ApplicationsServiceContract $service)
    {
        $this->_applicationService = $service;
    }

    /**
     * Handler for the API which lists all available Application models
     *
     * @param  ApplicationIndexRequestContract  $request
     * @return Response
     */
    public function __invoke(ApplicationIndexRequestContract $request): Response
    {
        $applicationsFilters = $request->getRequestFiltering();
        $availableApplications = $this->_applicationService->getAvailableApplications($applicationsFilters);

        return $this->resourceClass()::collection($availableApplications)
            ->toResponse($request);
    }
}
