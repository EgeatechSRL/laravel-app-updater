<?php

namespace EgeaTech\AppUpdater\Constants;

use BenSampo\Enum\Enum;

/**
 * @method static StorageDisk Public ()
 * @method static StorageDisk S3()
 */
final class StorageDisk extends Enum
{
    const Public = 'public';

    const Local = 'local';

    const Ftp = 'ftp';

    const S3 = 's3';
}
