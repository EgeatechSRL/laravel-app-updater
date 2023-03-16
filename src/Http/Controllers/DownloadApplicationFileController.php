<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationFileDownloadRequestContract;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadApplicationFileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $_applicationService;

    public function __construct(ApplicationsServiceContract $service)
    {
        $this->_applicationService = $service;
    }

    /**
     * Downloads the file associated to a specific Application
     *
     * @param  ApplicationId  $applicationId
     * @param  ApplicationFileDownloadRequestContract  $request
     * @return StreamedResponse
     */
    public function __invoke(ApplicationId $applicationId, ApplicationFileDownloadRequestContract $request)
    {
        $application = $this->_applicationService->getApplicationById($applicationId);

        return Storage::disk((string) $application->getStorageDisk())
            ->download(
                $application->getFilePath(),
                $application->getOriginalFileName(),
                [
                    'Content-Type' => 'application/vnd.android.package-archive',
                ]
            );
    }
}
