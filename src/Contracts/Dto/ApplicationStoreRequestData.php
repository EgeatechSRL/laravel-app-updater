<?php

namespace EgeaTech\AppUpdater\Contracts\Dto;

use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\ValueObjects\ApplicationVersion;
use EgeaTech\AppUpdater\ValueObjects\BuildNumber;
use Illuminate\Contracts\Support\Arrayable;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ApplicationStoreRequestData extends ApplicationUpdaterRequestData, Arrayable
{
    public function getApplicationName(): string;

    public function getBuildChannel(): ?BuildChannel;

    public function getBuildNumber(): BuildNumber;

    public function getVersion(): ApplicationVersion;

    public function getFile(): UploadedFile;
}
