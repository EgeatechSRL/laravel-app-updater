<?php

namespace EgeaTech\AppUpdater\Contracts\Http\Resources;

use Illuminate\Contracts\Support\Responsable;
use JsonSerializable;

interface ApplicationResourceContract extends JsonSerializable, Responsable
{
}
