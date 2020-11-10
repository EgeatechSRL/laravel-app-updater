<?php

namespace EgeaTech\AppUpdater\Contracts\Repositories;

use Illuminate\Support\Collection;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use EgeaTech\AppUpdater\ValueObjects\ApplicationFilePath;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationStoreRequestData;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdateRequestData;

interface ApplicationRepositoryContract
{
    /**
     * Finds the Application entity identified by given id
     *
     * @param ApplicationId $id
     * @return ApplicationModelContract
     */
    public function find(ApplicationId $id): ApplicationModelContract;

    /**
     * Finds the latest Application entity given provided filters
     *
     * @param array $findCriteria
     * @return null|ApplicationModelContract
     */
    public function findLatestVersionBy(array $findCriteria = []): ?ApplicationModelContract;

    /**
     * Finds all Application entities filtered by given criteria
     *
     * @param array $findCriteria
     * @return Collection<ApplicationModelContract>
     */
    public function findAllBy(array $findCriteria = []): Collection;

    /**
     * Stores a new Application entity
     *
     * @param ApplicationStoreRequestData $data
     * @param ApplicationFilePath $filePath
     * @return ApplicationModelContract
     */
    public function storeApplication(ApplicationStoreRequestData $data, ApplicationFilePath $filePath): ApplicationModelContract;

    /**
     * Updates an existing Application entity
     *
     * @param ApplicationId $id
     * @param ApplicationUpdateRequestData $data
     * @param ApplicationFilePath|null $filePath
     * @return ApplicationModelContract
     */
    public function updateApplication(ApplicationId $id, ApplicationUpdateRequestData $data, ?ApplicationFilePath $filePath): ApplicationModelContract;

    /**
     * Deletes an existing Application entity
     *
     * @param ApplicationId $id
     * @return bool
     */
    public function deleteApplication(ApplicationId $id): bool;
}
