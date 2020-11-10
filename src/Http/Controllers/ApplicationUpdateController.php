<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdateRequestData;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationUpdateRequestContract;

class ApplicationUpdateController extends BaseController
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
     * @param ApplicationId $applicationId
     * @param ApplicationUpdateRequestContract|Request $request
     * @return Response
     */
    public function __invoke(ApplicationId $applicationId, ApplicationUpdateRequestContract $request): Response
    {
        /** @var ApplicationUpdateRequestData $updateData */
        $updateData = $request->getRequestData();
        $updatedApplication = $this->_applicationService->updateApplication($applicationId, $updateData);

        return $this->resourceInstance($updatedApplication)
            ->toResponse($request)
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
