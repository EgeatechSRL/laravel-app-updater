<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | The disk where to store uploaded applications installers. The value must
    | refer to an existing
    |
    */
    'disk' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | The name of the folder where all application installers will be stored.
    |
    */
    'file_folder_name' => 'APK',

    /*
    |--------------------------------------------------------------------------
    | Migrations settings
    |--------------------------------------------------------------------------
    |
    | Here you can define the name of the table that will be created by the
    | package when running the migration file.
    |
    */
    'migrations' => [
        'applications_table_name' => 'applications',
    ],
];
