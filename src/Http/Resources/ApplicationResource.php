<?php

namespace EgeaTech\AppUpdater\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use EgeaTech\AppUpdater\Contracts\Http\Resources\ApplicationResourceContract;

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
            'original_file_name' => $this->resource->getOriginalFileName(),
            'updated_at' => $this->updated_at,
        ];
    }
}
