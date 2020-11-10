<?php

namespace EgeaTech\AppUpdater\Contracts\Dto;

use Illuminate\Contracts\Support\Arrayable;
use EgeaTech\AppUpdater\Constants\BuildChannel;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EgeaTech\AppUpdater\ValueObjects\ApplicationVersion;

interface ApplicationStoreRequestData extends ApplicationUpdaterRequestData, Arrayable
{
    public function getApplicationName(): string;

    public function getBuildChannel(): ?BuildChannel;

    public function getVersion(): ApplicationVersion;

    public function getFile(): UploadedFile;
}
