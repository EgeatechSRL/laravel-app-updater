<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationDeleteRequestContract;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @param  ApplicationId  $applicationId
     * @param  ApplicationDeleteRequestContract  $request
     * @return JsonResponse
     */
    public function __invoke(ApplicationId $applicationId, ApplicationDeleteRequestContract $request): JsonResponse
    {
        $this->_applicationService->deleteApplication($applicationId);

        return new JsonResponse(['data' => []], JsonResponse::HTTP_ACCEPTED);
    }
}
