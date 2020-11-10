<?php

use EgeaTech\AppUpdater\Models\Application;

return [
    'disk' => 'local',
    'file_folder_name' => 'APK',
    'migrations' => [
        'applications_table_name' => 'applications',
    ],
    'models' => [
        'application' => Application::class,
    ]
];
