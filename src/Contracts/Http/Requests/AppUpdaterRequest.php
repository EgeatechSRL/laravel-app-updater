<?php

namespace EgeaTech\AppUpdater\Contracts\Http\Requests;

use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdaterRequestData;

interface AppUpdaterRequest
{
    /**
     * Retrieves content of the request, properly formatted
     *
     * @return ApplicationUpdaterRequestData
     */
    public function getRequestData(): ApplicationUpdaterRequestData;
}
