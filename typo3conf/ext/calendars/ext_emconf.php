<?php

$EM_CONF['calendars'] = [
    'title' => 'Calendar',
    'description' => 'Calendar for events, holidays, bookings and more',
    'category' => 'plugin',
    'author' => 'Thomas Deuling - typo3@coding.ms',
    'author_email' => 'typo3@coding.ms',
    'author_company' => 'coding.ms',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '2.1.1',
    'constraints' => [
        'depends' => [
            'php' => '7.2.0-7.4.99',
            'typo3' => '9.5.0-10.4.99',
            'additional_tca' => '1.3.2-1.99.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
