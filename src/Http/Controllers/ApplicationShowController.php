<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationShowRequestContract;

class ApplicationShowController extends BaseController
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
     * Handler for the API which deletes an Application
     *
     * @param ApplicationId $applicationId
     * @param ApplicationShowRequestContract|Request $request
     * @return JsonResponse
     */
    public function __invoke(ApplicationId $applicationId, ApplicationShowRequestContract $request): Response
    {
        $applicationInstance = $this->_applicationService->getApplicationById($applicationId);

        return $this->resourceInstance($applicationInstance)
            ->toResponse($request);
    }
}
