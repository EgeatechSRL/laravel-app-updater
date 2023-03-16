<?php

namespace EgeaTech\AppUpdater\Http\Resources;

use EgeaTech\AppUpdater\Contracts\Http\Resources\ApplicationResourceContract;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read ApplicationModelContract $resource
 */
class ApplicationResource extends JsonResource implements ApplicationResourceContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->resource->getApplicationName(),
            'version' => $this->resource->getVersion(),
            'build_channel' => (string) $this->resource->getBuildChannel(),
            'build_number' => $this->resource->getBuildNumber(),
            'original_file_name' => $this->resource->getOriginalFileName(),
            'updated_at' => $this->updated_at,
        ];
    }
}
