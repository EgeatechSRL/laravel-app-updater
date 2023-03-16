<?php

namespace EgeaTech\AppUpdater\Models;

use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\Constants\StorageDisk;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;
use Illuminate\Database\Eloquent\Model;

class Application extends Model implements ApplicationModelContract
{
    use HasApplicationFields;

    protected $fillable = [
        'name',
        'build_channel',
        'build_number',
        'version',
        'storage_disk',
        'file_size',
        'original_file_name',
        'file_path',
    ];

    protected $casts = [
        'version' => 'string',
        'build_channel' => BuildChannel::class,
        'build_number' => 'integer',
        'storage_disk' => StorageDisk::class,
        'file_size' => 'integer',
    ];
}
