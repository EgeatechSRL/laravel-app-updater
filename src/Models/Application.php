<?php

namespace EgeaTech\AppUpdater\Models;

use Illuminate\Database\Eloquent\Model;
use EgeaTech\AppUpdater\Constants\StorageDisk;
use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;

class Application extends Model implements ApplicationModelContract
{
    use HasApplicationFields;

    protected $fillable = [
        'name',
        'build_channel',
        'version',
        'storage_disk',
        'file_size',
        'original_file_name',
        'file_path',
    ];

    protected $casts = [
        'version' => 'string',
        'build_channel' => BuildChannel::class,
        'storage_disk' => StorageDisk::class,
        'file_size' => 'integer',
    ];
}
