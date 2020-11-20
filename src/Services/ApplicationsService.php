<?php

namespace EgeaTech\AppUpdater\Services;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use EgeaTech\AppUpdater\Constants\StorageDisk;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EgeaTech\AppUpdater\ValueObjects\ApplicationFilePath;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationStoreRequestData;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdateRequestData;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationsListRequestFilters;
use EgeaTech\AppUpdater\Contracts\Services\ApplicationsServiceContract;
use EgeaTech\AppUpdater\Contracts\Repositories\ApplicationRepositoryContract;

class ApplicationsService implements ApplicationsServiceContract
{
    private $_applicationRepository;

    public function __construct(ApplicationRepositoryContract $repository)
    {
        $this->_applicationRepository = $repository;
    }

    public function getAvailableApplications(ApplicationsListRequestFilters $filters): Collection
    {
        return $this->_applicationRepository
            ->findAllBy($filters->getQueryWhereClauses());
    }

    public function getApplicationById(ApplicationId $applicationId): ApplicationModelContract
    {
        return $this->_applicationRepository->find($applicationId);
    }

    public function getLatestAvailableApplication(ApplicationsListRequestFilters $filters): ?ApplicationModelContract
    {
        return $this->_applicationRepository
            ->findLatestVersionBy($filters->getQueryWhereClauses());
    }

    public function storeApplication(ApplicationStoreRequestData $applicationData): ApplicationModelContract
    {
        $storageDisk = StorageDisk::coerce(config('app-updater.disk'));
        $filePath = $this->storeApplicationFile(
            $storageDisk,
            $applicationData->getFile()
        );

        return $this->_applicationRepository
            ->storeApplication(
                $applicationData,
                new ApplicationFilePath($filePath),
                $storageDisk
            );
    }

    public function updateApplication(ApplicationId $id, ApplicationUpdateRequestData $applicationData): ApplicationModelContract
    {
        $newFile = $applicationData->getFile();
        $storageDisk = StorageDisk::coerce(config('app-updater.disk'));
        $newFilePath = null;

        if ($newFile) {
            $application = $this->_applicationRepository->find($id);
            $newFilePath = new ApplicationFilePath(
                $this->replaceApplicationFile($application, $newFile)
            );
        }

        return $this->_applicationRepository
            ->updateApplication($id, $applicationData, $newFilePath, $storageDisk);
    }

    public function deleteApplication(ApplicationId $id): bool
    {
        $application = $this->_applicationRepository->find($id);

        $this->_applicationRepository->deleteApplication($id);
        $this->deleteApplicationFile($application);

        return true;
    }

    private function replaceApplicationFile(ApplicationModelContract $application, UploadedFile $newFile): string
    {
        $this->deleteApplicationFile($application);

        return $this->storeApplicationFile(
            $application->getStorageDisk(),
            $newFile
        );
    }

    /**
     * Stores inside $disk a new Application file
     *
     * @param StorageDisk $disk
     * @param UploadedFile $newFile
     * @return string The path of the new file
     * @throws Exception
     */
    private function storeApplicationFile(StorageDisk $disk, UploadedFile $newFile): string
    {
        $baseApplicationFilesPath = rtrim(
            config('app-updater.file_folder_name'),
            " \t\n\r\0\x0B/"
        );

        $newFileName = Str::uuid()->toString();
        $fileExtension = $newFile->getClientOriginalExtension();

        $filePath = Storage::disk((string) $disk)
            ->putFileAs($baseApplicationFilesPath, $newFile, "$newFileName.$fileExtension");

        if ($filePath === false) {
            throw new Exception('Cannot save the file');
        }

        return $filePath;
    }

    /**
     * Removes the file referenced by given Application from disk
     *
     * @param ApplicationModelContract $application
     * @return bool
     */
    private function deleteApplicationFile(ApplicationModelContract $application): bool
    {
        if (Storage::disk((string) $application->getStorageDisk())->exists($application->getFilePath())) {
            return Storage::disk((string) $application->getStorageDisk())->delete($application->getFilePath());
        }

        return true;
    }
}
