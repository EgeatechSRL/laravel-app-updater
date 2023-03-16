<?php

namespace EgeaTech\AppUpdater\Constants;

use BenSampo\Enum\Enum;

/**
 * @method static BuildChannel Stable()
 * @method static BuildChannel Beta()
 * @method static BuildChannel Testing()
 * @method static BuildChannel Development()
 */
final class BuildChannel extends Enum
{
    const Stable = 'stable';

    const Beta = 'beta';

    const Testing = 'testing';

    const Development = 'development';
}
