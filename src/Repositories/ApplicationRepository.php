<?php

namespace EgeaTech\AppUpdater\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use EgeaTech\AppUpdater\Constants\PdoError;
use EgeaTech\AppUpdater\Constants\StorageDisk;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\ValueObjects\ApplicationFilePath;
use EgeaTech\AppUpdater\Exceptions\InvalidVersionException;
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
        return ($this->_modelInstance)->findOrFail($id->getValue());
    }

    public function findLatestVersionBy(array $findCriteria = []): ?ApplicationModelContract
    {
        return ($this->_modelInstance)
            ->where($findCriteria)
            ->orderByDesc($this->_modelInstance->getBuildNumberField())
            ->first();
    }

    public function findAllBy(array $findCriteria = []): Collection
    {
        return ($this->_modelInstance)->where($findCriteria)->get();
    }

    public function storeApplication(ApplicationStoreRequestData $data, ApplicationFilePath $filePath, StorageDisk $storageDisk): ApplicationModelContract
    {
        try {

            $applicationData = $data->toArray();
            $applicationData[$this->_modelInstance->getFilePathField()] = $filePath->getValue();
            $applicationData[$this->_modelInstance->getStorageDiskField()] = $storageDisk->value;

            return ($this->_modelInstance)->create($applicationData);
        } catch (QueryException $exception) {
            if ($exception->getCode() === PdoError::DuplicatedValue) {
                throw new InvalidVersionException($exception);
            }

            throw $exception;
        }
    }

    public function updateApplication(ApplicationId $id, ApplicationUpdateRequestData $data, ?ApplicationFilePath $filePath, StorageDisk $storageDisk): ApplicationModelContract
    {
        try {

            $application = $this->find($id);
            $updateData = $data->toArray();

            // Dynamically update all available fields, which have been mapped according
            // to Model definition
            foreach ($updateData as $updatedField => $updatedValue) {
                $application->{$updatedField} = $updatedValue;
            }

            if ($filePath) {
                $application->{$this->_modelInstance->getFilePathField()} = $filePath->getValue();
                $application->{$this->_modelInstance->getStorageDiskField()} = $storageDisk->value;
            }

            $application->save();

            return $application;

        } catch (QueryException $exception) {
            if ($exception->getCode() === PdoError::DuplicatedValue) {
                throw new InvalidVersionException($exception);
            }

            throw $exception;
        }
    }

    public function deleteApplication(ApplicationId $id): bool
    {
        $application = $this->find($id);

        return $application->delete();
    }
}
