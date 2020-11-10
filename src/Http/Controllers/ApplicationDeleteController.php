<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationDeleteRequestContract;

class ApplicationDeleteController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $_applicationService;

    public function __construct(ApplicationsServiceContract $service)
    {
        $this->_applicationService = $service;
    }

    /**
     * Handler for the API which deletes an Application
     *
     * @param ApplicationId $applicationId
     * @param ApplicationDeleteRequestContract $request
     * @return JsonResponse
     */
    public function __invoke(ApplicationId $applicationId, ApplicationDeleteRequestContract $request): JsonResponse
    {
        $this->_applicationService->deleteApplication($applicationId);

        return new JsonResponse(['data' => []], JsonResponse::HTTP_ACCEPTED);
    }
}
