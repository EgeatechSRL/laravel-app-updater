<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdateRequestData;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationUpdateRequestContract;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Http\Controllers\Traits\ResolvesJsonResource;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

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
     * @param  ApplicationId  $applicationId
     * @param  ApplicationUpdateRequestContract|Request  $request
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
