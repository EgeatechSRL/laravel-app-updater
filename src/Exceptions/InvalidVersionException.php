<?php

namespace EgeaTech\AppUpdater\Exceptions;

use Exception;
use Illuminate\Support\Facades\Lang;
use Throwable;

class InvalidVersionException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        $message = Lang::get('app-updater::exceptions.duplicated_version');

        parent::__construct($message, 0, $previous);
    }
}
