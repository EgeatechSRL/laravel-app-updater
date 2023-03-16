<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationShowRequestContract;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
     * @param  ApplicationId  $applicationId
     * @param  ApplicationShowRequestContract|Request  $request
     * @return JsonResponse
     */
    public function __invoke(ApplicationId $applicationId, ApplicationShowRequestContract $request): Response
    {
        $applicationInstance = $this->_applicationService->getApplicationById($applicationId);

        return $this->resourceInstance($applicationInstance)
            ->toResponse($request);
    }
}
