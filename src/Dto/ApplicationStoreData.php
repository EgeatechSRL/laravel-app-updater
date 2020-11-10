<?php

namespace EgeaTech\AppUpdater\Dto;

use EgeaTech\AppUpdater\Constants\BuildChannel;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EgeaTech\AppUpdater\ValueObjects\ApplicationVersion;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationStoreRequestData;
use EgeaTech\AppUpdater\Contracts\Models\ApplicationModelContract;

class ApplicationStoreData implements ApplicationStoreRequestData
{
    private $_modelInstance;

    private $_applicationName;
    private $_buildChannel;
    private $_version;
    private $_file;

    public function __construct(array $requestData)
    {
        $this->_modelInstance = app(ApplicationModelContract::class);

        $this->_applicationName = $requestData['name'];
        $this->_buildChannel = BuildChannel::coerce($requestData['build_channel']);
        $this->_version = new ApplicationVersion($requestData['version']);
        $this->_file = $requestData['file'];
    }

    public function getApplicationName(): string
    {
        return $this->_applicationName;
    }

    public function getBuildChannel(): BuildChannel
    {
        return $this->_buildChannel;
    }

    public function getVersion(): ApplicationVersion
    {
        return $this->_version;
    }

    public function getFile(): UploadedFile
    {
        return $this->_file;
    }

    public function toArray(): array
    {
        $fileSize = $this->getFile()->getSize();
        $fileOriginalName = $this->getFile()->getClientOriginalName();

        return [
            $this->_modelInstance->getNameField() => $this->getApplicationName(),
            $this->_modelInstance->getBuildChannelField() => $this->getBuildChannel()->value,
            $this->_modelInstance->getVersionField() => $this->getVersion()->getValue(),
            $this->_modelInstance->getFileSizeField() => $fileSize,
            $this->_modelInstance->getOriginalFileNameField() => $fileOriginalName,
        ];
    }
}
