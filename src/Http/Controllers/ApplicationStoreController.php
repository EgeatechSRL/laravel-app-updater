<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationStoreRequestData;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationStoreRequestContract;

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
     * @param ApplicationStoreRequestContract|Request $request
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
