<?php

namespace EgeaTech\AppUpdater\Http\Controllers\Traits;

use EgeaTech\AppUpdater\Contracts\Http\Resources\ApplicationResourceContract;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;

trait ResolvesJsonResource
{
    private $_resourceClass;

    /**
     * Returns the FQDN of a Illuminate\Http\Resources\Json\JsonResource
     * instance
     *
     * @return string
     */
    private function resourceClass(): string
    {
        return get_class($this->resourceInstance());
    }

    private function resourceInstance(?ApplicationModelContract $applicationModel = null): ApplicationResourceContract
    {
        if ($applicationModel) {
            return app()->make(ApplicationResourceContract::class, ['resource' => $applicationModel]);
        }

        $applicationModel = app()->make(ApplicationModelContract::class);

        return app()->make(ApplicationResourceContract::class, ['resource' => $applicationModel]);
    }
}
