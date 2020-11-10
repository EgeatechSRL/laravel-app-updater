<?php

namespace EgeaTech\AppUpdater\ValueObjects;

final class ApplicationVersion
{
    private $_applicationVersion;

    public function __construct(string $version)
    {
        $this->_applicationVersion = $version;
    }

    public function getValue(): string
    {
        return $this->_applicationVersion;
    }
}
