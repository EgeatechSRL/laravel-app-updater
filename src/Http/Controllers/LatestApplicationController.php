<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use EgeaTech\AppUpdater\Contracts\Http\Requests\LatestApplicationRequestContract;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LatestApplicationController extends BaseController
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
     * Handles the API which retrieves the latest Application instance available
     *
     * @param  LatestApplicationRequestContract|Request  $request
     * @return Response
     */
    public function __invoke(LatestApplicationRequestContract $request): Response
    {
        $applicationFilters = $request->getRequestFiltering();
        $latestApplication = $this->_applicationService->getLatestAvailableApplication($applicationFilters);

        return $latestApplication
            ? $this->resourceInstance($latestApplication)->toResponse($request)
            : new JsonResponse(['data' => null]);
    }
}
