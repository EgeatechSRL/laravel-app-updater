<?php

namespace EgeaTech\AppUpdater\ValueObjects;

final class ApplicationId
{
    private $_applicationId;

    public function __construct(int $applicationId)
    {
        $this->_applicationId = $applicationId;
    }

    public function getValue(): int
    {
        return $this->_applicationId;
    }
}
