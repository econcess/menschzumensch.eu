<?php

/**
 * Extension Manager/Repository config file for ext "bootstrap_package_econcess".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'bootstrap package econcess',
    'description' => 'Bootstrap package based template for Infoniqa by econcess',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'bootstrap_package' => '12.0.0-12.9.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'EconcessGmbh\\BootstrapPackageEconcess\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'econcess GmbH',
    'author_email' => 'bk@econcess.de',
    'author_company' => 'econcess GmbH',
    'version' => '1.0.0',
];
