<?php

namespace EgeaTech\AppUpdater\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationFileDownloadRequestContract;

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
     * @param ApplicationId $applicationId
     * @param ApplicationFileDownloadRequestContract $request
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
                    'Content-Type' => 'application/vnd.android.package-archive'
                ]
            );
    }
}
