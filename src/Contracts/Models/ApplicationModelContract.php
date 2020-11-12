<?php

namespace EgeaTech\AppUpdater\Contracts\Models;

use Illuminate\Contracts\Support\Arrayable;
use EgeaTech\AppUpdater\Constants\StorageDisk;
use EgeaTech\AppUpdater\Constants\BuildChannel;

interface ApplicationModelContract extends Arrayable
{
    /**
     * Gets the name of the name field
     *
     * @return string
     */
    public function getNameField(): string;

    /**
     * Gets the name of the build channel field
     *
     * @return string
     */
    public function getBuildChannelField(): string;

    /**
     * Gets the name of the build number field
     *
     * @return string
     */
    public function getBuildNumberField(): string;

    /**
     * Gets the name of the version field
     *
     * @return string
     */
    public function getVersionField(): string;

    /**
     * Gets the name of the storage disk field
     *
     * @return string
     */
    public function getStorageDiskField(): string;

    /**
     * Gets the name of the file size field
     *
     * @return string
     */
    public function getFileSizeField(): string;

    /**
     * Gets the name of the original file name field
     *
     * @return string
     */
    public function getOriginalFileNameField(): string;

    /**
     * Gets the name of the file path field
     *
     * @return string
     */
    public function getFilePathField(): string;

    /**
     * Gets the identifier of an Application instance
     *
     * @return int
     */
    public function getApplicationId(): int;

    /**
     * Gets the friendly name for an Application
     *
     * @return string
     */
    public function getApplicationName(): string;

    /**
     * Returns the BuildChannel which this Application
     * targets to
     *
     * @return BuildChannel
     */
    public function getBuildChannel(): BuildChannel;

    /**
     * Retrieves the incremental number associated to this
     * Application instance
     *
     * @return int
     */
    public function getBuildNumber(): int;

    /**
     * Retrieves Application version (in semver format)
     *
     * @return string
     */
    public function getVersion(): string;

    /**
     * Retrieves the disk where Application file is stored
     *
     * @return StorageDisk
     */
    public function getStorageDisk(): StorageDisk;

    /**
     * Retrieves the filesize
     *
     * @return int
     */
    public function getFileSize(): int;

    /**
     * Gets the original name of the file before being upload to the server
     *
     * @return string
     */
    public function getOriginalFileName(): string;

    /**
     * Gets the path inside storage disk where the file resides
     *
     * @return string
     */
    public function getFilePath(): string;

    /**
     * Gets a Base64 string representation of application file
     *
     * @return string
     */
    public function getEncodedFile(): string;
}
