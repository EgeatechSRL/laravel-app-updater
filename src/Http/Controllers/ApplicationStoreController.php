<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use EgeaTech\AppUpdater\Contracts\Dto\ApplicationStoreRequestData;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationStoreRequestContract;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class ApplicationStoreController extends BaseController
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
     * Handler for the API endpoint which stores a new Application
     *
     * @param  ApplicationStoreRequestContract|Request  $request
     * @return Response
     */
    public function __invoke(ApplicationStoreRequestContract $request): Response
    {
        /** @var ApplicationStoreRequestData $applicationData */
        $applicationData = $request->getRequestData();
        $newApplication = $this->_applicationService->storeApplication($applicationData);

        return $this->resourceInstance($newApplication)
            ->toResponse($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
