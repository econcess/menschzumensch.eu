<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$extKey = 'calendars';
$table = 'tx_calendars_domain_model_calendareventcategory';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;

$return = [
    'ctrl' => [
        'title' => $lll,
        'label' => 'title',
        'label_alt' => 'variant',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,start_date,end_date,description,',
        'iconfile' => 'EXT:calendars/Resources/Public/Icons/iconmonstr-link-2.svg',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-content-calendars-calendareventcategory'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, variant, description',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                information,
                title,
                variant,
                description,

            --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_access') . ',
                hidden,
                starttime,
                endtime,

            --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_language') . ',
                sys_language_uid,
                l10n_parent,
                l10n_diffsource'
        ],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'information' => \CodingMs\AdditionalTca\Tca\Configuration::full('information', $table, $extKey),
        'sys_language_uid' => \CodingMs\AdditionalTca\Tca\Configuration::full('sys_language_uid'),
        'l10n_parent' => \CodingMs\AdditionalTca\Tca\Configuration::full('l10n_parent', $table),
        'l10n_diffsource' => \CodingMs\AdditionalTca\Tca\Configuration::full('l10n_diffsource'),
        't3ver_label' => \CodingMs\AdditionalTca\Tca\Configuration::full('t3ver_label'),
        'hidden' => \CodingMs\AdditionalTca\Tca\Configuration::full('hidden'),
        'starttime' => \CodingMs\AdditionalTca\Tca\Configuration::full('starttime'),
        'endtime' => \CodingMs\AdditionalTca\Tca\Configuration::full('endtime'),
        'title' => [
            'exclude' => 0,
            'label' => $lll . '.title',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string', true),
        ],
        'variant' => [
            'exclude' => 0,
            'label' => $lll . '.variant',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('select', false, false, '', [
                ['default', 'default'],
                ['primary', 'primary'],
                ['secondary', 'secondary'],
                ['success', 'success'],
                ['info', 'info'],
                ['warning', 'warning'],
                ['danger', 'danger'],
            ]),
        ],
        'description' => [
            'exclude' => 0,
            'label' => $lll . '.description',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('rte'),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled]',
        ],
    ],
];

return $return;
