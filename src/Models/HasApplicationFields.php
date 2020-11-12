<?php

namespace EgeaTech\AppUpdater\Models;

use Illuminate\Support\Facades\Storage;
use EgeaTech\AppUpdater\Constants\StorageDisk;
use EgeaTech\AppUpdater\Constants\BuildChannel;

trait HasApplicationFields
{
    public function getNameField(): string
    {
        return 'name';
    }

    public function getBuildChannelField(): string
    {
        return 'build_channel';
    }

    public function getBuildNumberField(): string
    {
        return 'build_number';
    }

    public function getVersionField(): string
    {
        return 'version';
    }

    public function getStorageDiskField(): string
    {
        return 'storage_disk';
    }

    public function getFileSizeField(): string
    {
        return 'file_size';
    }

    public function getOriginalFileNameField(): string
    {
        return 'original_file_name';
    }

    public function getFilePathField(): string
    {
        return 'file_path';
    }

    public function getApplicationId(): int
    {
        return $this->{$this->getKeyName()};
    }

    public function getApplicationName(): string
    {
        return $this->{$this->getNameField()};
    }

    public function getBuildChannel(): BuildChannel
    {
        return $this->{$this->getBuildChannelField()};
    }

    public function getBuildNumber(): int
    {
        return $this->{$this->getBuildNumberField()};
    }

    public function getVersion(): string
    {
        return $this->{$this->getVersionField()};
    }

    public function getStorageDisk(): StorageDisk
    {
        return $this->{$this->getStorageDiskField()};
    }

    public function getFileSize(): int
    {
        return $this->{$this->getFileSizeField()};
    }

    public function getOriginalFileName(): string
    {
        return $this->{$this->getOriginalFileNameField()};
    }

    public function getFilePath(): string
    {
        return $this->{$this->getFilePathField()};
    }

    public function getEncodedFile(): string
    {
        return base64_encode(
            Storage::disk($this->getStorageDisk()->value)
                ->get($this->getFilePath())
        );
    }
}
