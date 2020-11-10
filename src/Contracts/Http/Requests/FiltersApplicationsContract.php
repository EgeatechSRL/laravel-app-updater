<?php

namespace EgeaTech\AppUpdater\Contracts\Http\Requests;

use EgeaTech\AppUpdater\Contracts\Dto\ApplicationsListRequestFilters;

interface FiltersApplicationsContract
{
    /**
     * Retrieves desired filters to be applied in Application
     * retrieval
     *
     * @return ApplicationsListRequestFilters
     */
    public function getRequestFiltering(): ApplicationsListRequestFilters;
}
