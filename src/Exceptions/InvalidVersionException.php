<?php

namespace EgeaTech\AppUpdater\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Lang;

class InvalidVersionException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        $message = Lang::get('app-updater::exceptions.duplicated_version');

        parent::__construct($message, 0, $previous);
    }
}
