<?php

namespace EgeaTech\AppUpdater\Contracts\Services;

use EgeaTech\AppUpdater\Contracts\Dto\ApplicationsListRequestFilters;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationStoreRequestData;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdateRequestData;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use EgeaTech\AppUpdater\ValueObjects\ApplicationId;
use Illuminate\Support\Collection;

interface ApplicationsServiceContract
{
    /**
     * Retrieves the list of Application models
     *
     * @param  ApplicationsListRequestFilters  $filters
     * @return Collection<ApplicationModelContract>
     */
    public function getAvailableApplications(ApplicationsListRequestFilters $filters): Collection;

    /**
     * Fetches an Application given its id
     *
     * @param  ApplicationId  $applicationId
     * @return ApplicationModelContract
     */
    public function getApplicationById(ApplicationId $applicationId): ApplicationModelContract;

    /**
     * Fetches the latest Application from the valid
     * ones according to provided filters
     *
     * @param  ApplicationsListRequestFilters  $filters
     * @return ApplicationModelContract|null
     */
    public function getLatestAvailableApplication(ApplicationsListRequestFilters $filters): ?ApplicationModelContract;

    /**
     * Stores a new Application
     *
     * @param  ApplicationStoreRequestData  $applicationData
     * @return ApplicationModelContract
     */
    public function storeApplication(ApplicationStoreRequestData $applicationData): ApplicationModelContract;

    /**
     * Updates an existing Application
     *
     * @param  ApplicationId  $id
     * @param  ApplicationUpdateRequestData  $applicationData
     * @return ApplicationModelContract
     */
    public function updateApplication(ApplicationId $id, ApplicationUpdateRequestData $applicationData): ApplicationModelContract;

    /**
     * Removes an existing Application from the database,
     * removing its associated files too
     *
     * @param  ApplicationId  $id
     * @return bool
     */
    public function deleteApplication(ApplicationId $id): bool;
}
