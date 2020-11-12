<?php

namespace EgeaTech\AppUpdater\Contracts\Dto;

use Illuminate\Contracts\Support\Arrayable;
use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\ValueObjects\BuildNumber;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EgeaTech\AppUpdater\ValueObjects\ApplicationVersion;

interface ApplicationUpdateRequestData extends ApplicationUpdaterRequestData, Arrayable
{
    public function getApplicationName(): string;

    public function getBuildChannel(): BuildChannel;

    public function getBuildNumber(): BuildNumber;

    public function getVersion(): ApplicationVersion;

    public function getFile(): ?UploadedFile;
}
