<?php

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2021 TYPO3 econcess Bastian Kretzschmar <bk@econcess.de>
 *
 * All rights reserved
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

$EM_CONF['ec_news_sections'] = [
    'title' => 'News Records with Section Index Content Element',
    'description' => '',
    'category' => 'be',
    'shy' => 0,
    'version' => '1.0.0',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'loadOrder' => '',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearcacheonload' => 0,
    'lockType' => '',
    'author' => 'econcess GmbH (Bastian Kretzschmar)',
    'author_email' => 'bk@econcess.de',
    'author_company' => 'econcess GmbH',
    'CGLcompliance' => '',
    'CGLcompliance_note' => '',
    'constraints' => [
        'depends' => [
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    '_md5_values_when_last_written' => '',
	'autoload' => [
        'psr-4' => [
            'Econcess\\NewsSections\\' => 'Classes',
        ],
    ],
];
