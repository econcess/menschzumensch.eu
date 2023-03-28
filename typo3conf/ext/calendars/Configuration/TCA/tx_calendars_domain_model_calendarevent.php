<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$extKey = 'calendars';
$table = 'tx_calendars_domain_model_calendarevent';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;

$return = [
    'ctrl' => [
        'title' => $lll,
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'start_date',
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
        'searchFields' => 'title,subtitle,',
        'iconfile' => 'EXT:calendars/Resources/Public/Icons/iconmonstr-calendar-9.svg',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-content-calendars-calendarevent'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, calendar_event_category, start_date, end_date, registration_pid, description, ticket_amount, tickets_available, hide_links_to_detail_view, attribute1, attribute2, attribute3, attribute4',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                information,
                title,
                subtitle,
                slug,
                frontend_user,

            --palette--;' . $lll . '.palette_start_and_end_date;start_and_end_date,
                hide_links_to_detail_view,
                teaser,
                description,
                external_link,
                attribute1,
                attribute2,
                attribute3,
                attribute4,

            --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_relations') . ',
                calendar_event_category,
                files,

            --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_registration') . ',
                registration_pid,
                registration_address,
               --palette--;' . $lll . '.palette_tickets;tickets,
                registrations,
                info,

            --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_images') . ',
                images,

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
        'start_and_end_date' => ['showitem' => 'start_date, end_date', 'canNotCollapse' => 1],
        'tickets' => ['showitem' => 'ticket_amount, tickets_available', 'canNotCollapse' => 1],
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
        'deleted' => [
            'label' => 'deleted',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('checkbox')
        ],
        'title' => [
            'exclude' => 0,
            'label' => $lll . '.title',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string', true),
        ],
        'subtitle' => [
            'exclude' => 0,
            'label' => $lll . '.subtitle',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string')
        ],
        'slug' => [
            'exclude' => 0,
            'label' => $lll . '.slug',
            'config' => \CodingMs\Calendars\Tca\Configuration::get('slug', true, false, '', ['field' => 'title']),
        ],
        'calendar_event_category' => [
            'exclude' => 0,
            'label' => $lll . '.categories',
            'config' => \CodingMs\Calendars\Tca\Configuration::get('calendar_event_category')
        ],
        'start_date' => [
            'exclude' => 0,
            'label' => $lll . '.start_date',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('dateTime', false, false, '', ['dbType' => 'timestamp']),
        ],
        'end_date' => [
            'exclude' => 0,
            'label' => $lll . '.end_date',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('dateTime', false, false, '', ['dbType' => 'timestamp']),
        ],
        'registration_pid' => [
            'exclude' => 0,
            'label' => $lll . '.registration_pid',
            'config' => \CodingMs\Calendars\Tca\Configuration::get('registration_pid')
        ],
        'registration_address' => [
            'exclude' => 0,
            'label' => $lll . '.registration_address',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('select', false, false, '', [
                ['Default receiver (defined by TypoScript)', 'default'],
            ]),
        ],
        'registrations' => [
            'exclude' => false,
            'label' => $lll . '.registrations',
            'config' => \CodingMs\Calendars\Tca\Configuration::get('registrations')
        ],
        'files' => [
            'exclude' => false,
            'label' => $lll . '.files',
            'config' => \CodingMs\Calendars\Tca\Configuration::get('files')
        ],
        'hide_links_to_detail_view' => [
            'exclude' => 0,
            'label' => $lll . '.hide_links_to_detail_view',
            'config' => [
                'type' => 'check',
            ]
        ],
        'teaser' => [
            'exclude' => 0,
            'label' => $lll . '.teaser',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('textareaSmall'),
        ],
        'description' => [
            'exclude' => 0,
            'label' => $lll . '.description',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('rte'),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled]',
        ],
        'external_link' => [
            'exclude' => 0,
            'label' => $lll . '.external_link',
            'config' => \CodingMs\Calendars\Tca\Configuration::get('external_link', false, false, 'external_link_formlabel')
        ],
        'ticket_amount' => [
            'exclude' => 0,
            'label' => $lll . '.ticket_amount',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('int'),
        ],
        'tickets_available' => [
            'exclude' => 0,
            'label' => $lll . '.tickets_available',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('int'),
        ],
        'images' => [
            'exclude' => 0,
            'label' => $lll . '.images',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'images',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => $lll . '.images_add',
                        'showPossibleLocalizationRecords' => true,
                        'showRemovedLocalizationRecords' => true,
                        'showAllLocalizationLink' => true,
                        'showSynchronizationLink' => true
                    ],
                    'foreign_match_fields' => [
                        'fieldname' => 'images',
                        'tablenames' => 'tx_calendars_domain_model_calendarevent',
                        'table_local' => 'sys_file',
                    ],
                    // custom configuration for displaying fields in the overlay/reference table
                    // to use the newsPalette and imageoverlayPalette instead of the basicoverlayPalette
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                    --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;calendarsCalendarEventPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;calendarsCalendarEventPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                        ]
                    ]
                ],
                $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
            )
        ],
        'info' => [
            'exclude' => 0,
            'label' => $lll . '.info',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('textareaSmall'),
        ],
        'attribute1' => [
            'exclude' => 0,
            'label' => $lll . '.attribute1',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'attribute2' => [
            'exclude' => 0,
            'label' => $lll . '.attribute2',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'attribute3' => [
            'exclude' => 0,
            'label' => $lll . '.attribute3',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'attribute4' => [
            'exclude' => 0,
            'label' => $lll . '.attribute4',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'frontend_user' => [
            'exclude' => false,
            'label' => $lll . '.frontend_user',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('frontend_user'),
        ],
    ],
];

return $return;
