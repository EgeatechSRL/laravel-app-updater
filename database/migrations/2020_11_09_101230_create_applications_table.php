<?php

use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\Constants\StorageDisk;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    private $_tableName;

    public function __construct()
    {
        $this->_tableName = config('app-updater.migrations.applications_table_name');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->_tableName, function (Blueprint $table) {
            $publicDisk = StorageDisk::Public;
            $localDisk = StorageDisk::Local;
            $ftpDisk = StorageDisk::Ftp;
            $s3Disk = StorageDisk::S3;

            $stableBuild = BuildChannel::Stable;
            $betaBuild = BuildChannel::Beta;
            $testingBuild = BuildChannel::Testing;
            $developmentBuild = BuildChannel::Development;

            $table->id();

            $table->string('name');

            $table->enum('build_channel', [
                $stableBuild,
                $betaBuild,
                $testingBuild,
                $developmentBuild,
            ])->default($stableBuild);

            $table->bigInteger('build_number');

            $table->string('version')->default('0.0.1');

            $table->enum('storage_disk', [
                $publicDisk,
                $localDisk,
                $ftpDisk,
                $s3Disk,
            ])->default($publicDisk);

            $table->string('original_file_name');

            $table->string('file_path');

            $table->unsignedBigInteger('file_size')->default(0);

            $table->timestamps();

            $table->unique(['build_channel', 'version', 'build_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->_tableName);
    }
}
