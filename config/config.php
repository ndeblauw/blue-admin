<?php

return [
    'fontawesomekit_url' => 'https://kit.fontawesome.com/0bde3bbac3.js',
    
    'vite' => false,
    'livewire_v3' => false,

    'ckeditor' => true,

    'font' => [
        'include' => 'https://fonts.bunny.net/css?family=sofia-sans',
        'family' => 'Sofia Sans',
    ],

    'filepond_temporary_files_disk' => 'local',
    'filepond_temporary_files_path' => 'filepond',

    'menu' => [
        [
            'title' => 'Dashboard',
            'link' => 'admin/',
            'icon' => 'fa-home',
        ],
    ],

    'details_for' => 'Details for',
    'record_of_type' => 'Record of the type',
    'create_new' => 'Create New',
];

// TODO clean out things that don't belong in the configuration file
