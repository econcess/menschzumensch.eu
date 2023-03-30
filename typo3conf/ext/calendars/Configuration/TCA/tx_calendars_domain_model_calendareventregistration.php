<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$extKey = 'calendars';
$table = 'tx_calendars_domain_model_calendareventregistration';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;

$return = [
    'ctrl' => [
        'title' => $lll,
        'label' => 'last_name',
        'label_alt' => 'first_name',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
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
        'searchFields' => 'last_name,',
        'iconfile' => 'EXT:calendars/Resources/Public/Icons/iconmonstr-calendar-9.svg',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-content-calendars-calendarevent'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, last_name, first_name, frontend_user, email, address, zip, city, telephone, fax, message',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;;first_and_last_name,
                frontend_user,
                --palette--;;address_and_zip_and_city,
                email,
                --palette--;;telephone_and_fax,
                message,
            --div--;' . $lll . '.tab_event,
                event'
        ],
    ],
    'palettes' => [
        'first_and_last_name' => ['showitem' => 'first_name, last_name'],
        'telephone_and_fax' => ['showitem' => 'telephone, fax'],
        'address_and_zip_and_city' => ['showitem' => 'address,  --linebreak--, zip, city'],
    ],
    'columns' => [
        'sys_language_uid' => \CodingMs\AdditionalTca\Tca\Configuration::full('sys_language_uid'),
        'l10n_parent' => \CodingMs\AdditionalTca\Tca\Configuration::full('l10n_parent', $table),
        'l10n_diffsource' => \CodingMs\AdditionalTca\Tca\Configuration::full('l10n_diffsource'),
        't3ver_label' => \CodingMs\AdditionalTca\Tca\Configuration::full('t3ver_label'),
        'hidden' => \CodingMs\AdditionalTca\Tca\Configuration::full('hidden'),
        'starttime' => \CodingMs\AdditionalTca\Tca\Configuration::full('starttime'),
        'endtime' => \CodingMs\AdditionalTca\Tca\Configuration::full('endtime'),
        'last_name' => [
            'exclude' => 0,
            'label' => $lll . '.last_name',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string', true),
        ],
        'first_name' => [
            'exclude' => 0,
            'label' => $lll . '.first_name',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'address' => [
            'exclude' => 0,
            'label' => $lll . '.address',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('textareaSmall'),
        ],
        'zip' => [
            'exclude' => 0,
            'label' => $lll . '.zip',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'city' => [
            'exclude' => 0,
            'label' => $lll . '.city',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'email' => [
            'exclude' => 0,
            'label' => $lll . '.email',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string', true),
        ],
        'telephone' => [
            'exclude' => 0,
            'label' => $lll . '.telephone',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'fax' => [
            'exclude' => 0,
            'label' => $lll . '.fax',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'message' => [
            'exclude' => 0,
            'label' => $lll . '.message',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('textareaSmall'),
        ],
        'frontend_user' => [
            'exclude' => false,
            'label' => $lll . '.frontend_user',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('frontend_user'),
        ],
        'event' => [
            'exclude' => false,
            'label' => $lll . '.event',
            'config' => \CodingMs\Calendars\Tca\Configuration::get('event')
        ],
    ],
];

return $return;
