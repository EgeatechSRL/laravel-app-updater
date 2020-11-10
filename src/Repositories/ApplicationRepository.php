<?php

namespace EgeaTech\AppUpdater\Repositories;

use Composer\Semver\Semver;
use Illuminate\Support\Collection;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\ValueObjects\ApplicationFilePath;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationStoreRequestData;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdateRequestData;
use EgeaTech\AppUpdater\Contracts\Repositories\ApplicationRepositoryContract;

class ApplicationRepository implements ApplicationRepositoryContract
{
    private $_modelInstance;

    public function __construct(ApplicationModelContract $model)
    {
        $this->_modelInstance = $model;
    }

    public function find(ApplicationId $id): ApplicationModelContract
    {
        return ($this->_modelInstance)->find($id->getValue());
    }

    public function findLatestVersionBy(array $findCriteria = []): ?ApplicationModelContract
    {
        $modelVersionColumnName = $this->_modelInstance->getVersionField();

        /** @var Collection $filteredApplications */
        $filteredApplications = ($this->_modelInstance)
            ->where($findCriteria)
            ->get();

        if ($filteredApplications->isEmpty()) {
            return null;
        }

        $sortedVersions = Semver::rsort($filteredApplications->pluck($modelVersionColumnName)->toArray());
        $latestVersion = $sortedVersions[0];

        return $filteredApplications
            ->first(function(ApplicationModelContract $model) use ($modelVersionColumnName, $latestVersion) {
                return $model->{$modelVersionColumnName} === $latestVersion;
            });
    }

    public function findAllBy(array $findCriteria = []): Collection
    {
        return ($this->_modelInstance)->where($findCriteria)->get();
    }

    public function storeApplication(ApplicationStoreRequestData $data, ApplicationFilePath $filePath): ApplicationModelContract
    {
        $applicationData = $data->toArray();
        $applicationData[$this->_modelInstance->getFilePathField()] = $filePath->getValue();

        return ($this->_modelInstance)->create($applicationData);
    }

    public function updateApplication(ApplicationId $id, ApplicationUpdateRequestData $data, ?ApplicationFilePath $filePath): ApplicationModelContract
    {
        $application = $this->find($id);
        $updateData = $data->toArray();

        // Dynamically update all available fields, which have been mapped according
        // to Model definition
        foreach ($updateData as $updatedField => $updatedValue) {
            $application->{$updatedField} = $updatedValue;
        }

        if ($filePath) {
            $application->{$this->_modelInstance->getFilePathField()} = $filePath->getValue();
        }

        $application->save();

        return $application;
    }

    public function deleteApplication(ApplicationId $id): bool
    {
        $application = $this->find($id);

        return $application->delete();
    }
}
