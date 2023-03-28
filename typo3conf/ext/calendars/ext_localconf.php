<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'CodingMs.calendars',
    'CalendarList',
    ['Calendar' => 'listEvents,showEvent'],
    ['Calendar' => 'listEvents']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'CodingMs.calendars',
    'CalendarMonth',
    ['Calendar' => 'showMonth'],
    ['Calendar' => 'showMonth']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'CodingMs.calendars',
    'Registration',
    ['Registration' => 'showRegistration,saveRegistration'],
    ['Registration' => 'showRegistration,saveRegistration']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'CodingMs.calendars',
    'CalendarFullYear',
    ['Calendar' => 'showFullYear'],
    []
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'CodingMs.calendars',
    'JsonApi',
    ['JsonApi' => 'select'],
    ['JsonApi' => 'select']
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:calendars/Configuration/PageTS/tsconfig.typoscript">'
);

