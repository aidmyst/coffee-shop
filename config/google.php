<?php

return [
    'application_name' => env('APP_NAME', 'Laravel'),

    'default' => 'service_account',

    'service_account' => [
        'file' => storage_path('app/google-access.json'),
        'type' => 'service_account',
    ],

    'scopes' => [
        \Google\Service\Sheets::SPREADSHEETS,
        \Google\Service\Drive::DRIVE_METADATA_READONLY,
    ],

    'access_type' => 'offline',
    'approval_prompt' => 'force',
    'prompt' => 'consent',
];