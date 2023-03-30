<?php
defined('TYPO3_MODE') or die();

/**
 * Add extra field preview and some special news controls to sys_file_reference record
 */
$newSysFileReferenceColumns = [
    'preview' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendars/Resources/Private/Language/locallang_db.xlf:sys_file_reference.preview',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_file_reference',
    $newSysFileReferenceColumns
);

// add special news palette
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference',
    'calendarsCalendarEventPalette',
    'preview'
);
