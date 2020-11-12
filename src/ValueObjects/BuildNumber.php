<?php

namespace EgeaTech\AppUpdater\ValueObjects;

final class BuildNumber
{
    private $_buildNumber;

    public function __construct(int $buildNumber)
    {
        $this->_buildNumber = $buildNumber;
    }

    public function getValue(): int
    {
        return $this->_buildNumber;
    }
}
