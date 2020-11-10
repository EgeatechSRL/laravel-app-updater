<?php

namespace EgeaTech\AppUpdater\ValueObjects;

final class ApplicationFilePath
{
    private $_path;

    public function __construct(string $filePath)
    {
        $this->_path = $filePath;
    }

    public function getValue(): string
    {
        return $this->_path;
    }
}
