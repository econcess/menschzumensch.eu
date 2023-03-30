<?php

declare(strict_types=1);

namespace CodingMs\AdditionalTca\Tca;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Resource\AbstractFile;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Configuration presets for TCA fields.
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class Configuration
{

    /**
     * @param string $type
     * @param bool $required
     * @param bool $readonly
     * @param string $label Additional label, e.g. checkboxes.
     * @param array<string, mixed> $options Options for select boxes, field name for slug
     * @return array<string, mixed>
     */
    public static function get(
        string $type,
        bool $required = false,
        bool $readonly = false,
        string $label = '',
        array $options=[]
    ): array {
        $config = [];
        switch ($type) {
            case 'slug':
                $options['field'] = $options['field'] ?? 'title';
                $config = [
                    'type' => 'slug',
                    'size' => 50,
                    'prependSlash' => true,
                    'generatorOptions' => [
                        'fields' => [$options['field']],
                        'prefixParentPageSlug' => true,
                        'replacements' => [
                            '/' => '-'
                        ],
                    ],
                    'fallbackCharacter' => '-',
                    'eval' => 'lower,unique',
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'rte':
                $config = [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 15,
                    'eval' => 'trim',
                    'enableRichtext' => 1,
                    'richtextConfiguration' => 'default',
                    'default' => '',
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'textareaSmall':
                $config = [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 5,
                    'eval' => 'trim',
                    'default' => '',
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'textareaLarge':
                $config = [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 15,
                    'eval' => 'trim',
                    'default' => '',
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'markdown':
                $config = [
                    'type' => 'text',
                    'renderType' => 't3editor',
                    'format' => 'markdown',
                    'cols' => 80,
                    'rows' => 60,
                    'eval' => 'trim',
                    'default' => '',
                ];
                break;
            case 'html':
                $config = [
                    'type' => 'text',
                    'renderType' => 't3editor',
                    'format' => 'html',
                    'cols' => 80,
                    'rows' => 60,
                    'eval' => 'trim',
                    'default' => '',
                ];
                break;
            case 'int':
                $config = [
                    'type' => 'input',
                    'size' => 4,
                    'eval' => 'int',
                ];
                if (isset($options['lower']) && isset($options['upper'])) {
                    $config['range'] = [
                        'lower' => $options['lower'],
                        'upper' => $options['upper'],
                    ];
                }
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'currency':
                $config = [
                    'type' => 'input',
                    'renderType' => 'Currency',
                    'size' => 12,
                    'eval' => 'int',
                    'readOnly' => false,
                    'default' => '0',
                    'fieldInformation' => [
                        'AdditionalInfoPageTitle' => [
                            'renderType' => 'Currency',
                        ],
                    ],
                    'dbType' => $options['dbType'] ?? null,
                ];
                // Save as float number?
                if (isset($options['dbType']) && $options['dbType'] === 'float') {
                    $config['eval'] = 'double2';
                }
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'percent':
                $config = [
                    'type' => 'input',
                    'renderType' => 'Percent',
                    'size' => 4,
                    'eval' => 'int',
                    'default' => 0,
                    'fieldInformation' => [
                        'AdditionalInfoPageTitle' => [
                            'renderType' => 'Percent',
                        ],
                    ],
                    'dbType' => $options['dbType'] ?? null,
                ];
                // Save as float number?
                if (isset($options['dbType']) && $options['dbType'] === 'float') {
                    $config['eval'] = 'double2';
                }
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'string':
                $config = [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim'
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'email':
                $config = [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'email,trim'
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'color':
                $config = [
                    'type' => 'input',
                    'renderType' => 'colorpicker',
                    'size' => 10,
                    'eval' => ''
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'checkbox':
                $config = [
                    'type' => 'check',
                    'items' => [
                        [$label, '1'],
                    ],
                    'default' => 0,
                ];
                break;
            case 'link':
                $config = [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 50,
                    'max' => 1024,
                    'eval' => 'trim',
                    'softref' => 'typolink',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => $options,
                        ],
                    ],
                ];
                break;
            case 'date':
                $options['dbType'] = $options['dbType'] ?? 'timestamp';
                $config = [
                    'dbType' => 'date',
                    'type' => 'input',
                    'renderType' => 'inputDateTime',
                    'size' => 12,
                    'eval' => 'date',
                    'default' => null,
                ];
                // Save as timestamp?
                if ($options['dbType'] === 'timestamp') {
                    unset($config['dbType']);
                    $config['eval'] .= ',int';
                    $config['default'] = 0;
                }
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'dateTime':
                $options['dbType'] = $options['dbType'] ?? 'timestamp';
                $config = [
                    'dbType' => 'datetime',
                    'type' => 'input',
                    'renderType' => 'inputDateTime',
                    'size' => 12,
                    'eval' => 'datetime',
                    'default' => null,
                ];
                // Save as timestamp?
                if ($options['dbType'] === 'timestamp') {
                    unset($config['dbType']);
                    $config['eval'] .= ',int';
                    $config['default'] = 0;
                }
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'select':
                $config = [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'eval' => 'trim',
                    'items' => $options,
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'fileSingle':
                $field = $options['field'] ?? 'fileSingle';
                $config = ExtensionManagementUtility::getFileFieldTCAConfig(
                    $field,
                    [
                        'size' => '1',
                        'maxitems' => '1',
                        'minitems' => $required ? '1' : '0',
                        'eval' => '',
                        'show_thumbs' => '1',
                        'wizards' => [
                            'suggest' => [
                                'type' => 'suggest'
                            ],
                        ]
                    ],
                    'md'
                );
                break;
            case 'fileCollectionSingleInline':
                $config = [
                    'type' => 'inline',
                    'foreign_table' => 'sys_file_collection',
                    'minitems' => 0,
                    'maxitems' => 1,
                    'appearance' => [
                        'collapseAll' => 0,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 1,
                        'showPossibleLocalizationRecords' => 1,
                        'showAllLocalizationLink' => 1
                    ],
                ];
                if ($required) {
                    $config['minitems'] = 1;
                }
                break;
            case 'imageSingleAltTitle':
                $field = $options['field'] ?? 'image';
                $config =  ExtensionManagementUtility::getFileFieldTCAConfig($field);
                $config['maxitems'] = 1;
                $config['default'] = 0;
                $fileTypes = 'png,jpg,jpeg';
                if (isset($options['fileTypes'])) {
                    $fileTypes = $options['fileTypes'];
                }
                $config['overrideChildTca'] = [
                    'columns' => [
                        'uid_local' => [
                            'config' => [
                                'appearance' => [
                                    'elementBrowserAllowed' => $fileTypes,
                                    'elementBrowserType' => 'file',
                                ],
                            ],
                        ],
                    ],
                    'types' => [
                        '0' => [
                            'showitem' => 'title,alternative,
                           --palette--;;filePalette'
                        ],
                        AbstractFile::FILETYPE_IMAGE => [
                            'showitem' => 'title,alternative,
                           --palette--;;filePalette'
                        ],
                    ]
                ];
                if (isset($options['field']) && isset($options['table'])) {
                    $config['foreign_match_fields'] = [
                        'fieldname' => $options['field'],
                        'tablenames' => $options['table'],
                        'table_local' => 'sys_file',
                    ];
                }
                if ($required) {
                    $config['minitems'] = 1;
                }
                break;
            case 'imageSingleTitleDescription':
                $field = $options['field'] ?? 'image';
                $config =  ExtensionManagementUtility::getFileFieldTCAConfig($field);
                $config['maxitems'] = 1;
                $fileTypes = 'png,jpg,jpeg';
                if (isset($options['fileTypes'])) {
                    $fileTypes = $options['fileTypes'];
                }
                $config['overrideChildTca'] = [
                    'columns' => [
                        'uid_local' => [
                            'config' => [
                                'appearance' => [
                                    'elementBrowserAllowed' => $fileTypes,
                                    'elementBrowserType' => 'file',
                                ],
                            ],
                        ],
                    ],
                    'types' => [
                        '0' => [
                            'showitem' => 'title,description,
                           --palette--;;filePalette'
                        ],
                        AbstractFile::FILETYPE_IMAGE => [
                            'showitem' => 'title,description,
                           --palette--;;filePalette'
                        ],
                    ]
                ];
                if (isset($options['field']) && isset($options['table'])) {
                    $config['foreign_match_fields'] = [
                        'fieldname' => $options['field'],
                        'tablenames' => $options['table'],
                        'table_local' => 'sys_file',
                    ];
                }
                if ($required) {
                    $config['minitems'] = 1;
                }
                break;
            case 'images':
                $field = $options['field'] ?? 'image';
                $config = ExtensionManagementUtility::getFileFieldTCAConfig($field, [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    // custom configuration for displaying fields in the overlay/reference table
                    // to use the imageoverlayPalette instead of the basicoverlayPalette
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            AbstractFile::FILETYPE_TEXT => [
                                'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            AbstractFile::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            AbstractFile::FILETYPE_AUDIO => [
                                'showitem' => '
                                --palette--;;audioOverlayPalette,
                                --palette--;;filePalette'
                            ],
                            AbstractFile::FILETYPE_VIDEO => [
                                'showitem' => '
                                --palette--;;videoOverlayPalette,
                                --palette--;;filePalette'
                            ],
                            AbstractFile::FILETYPE_APPLICATION => [
                                'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                            ]
                        ],
                    ],
                ], $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']);
                if ($required) {
                    $config['minitems'] = 1;
                }
                break;
            case 'coordinate':
                $config = [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'double8',
                    'default' => 0.0,
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
            case 'frontend_user':
                // @todo Must be removed and migrated to frontendUserSingle
            case 'frontendUserSingle':
                $config = [
                    'type' => 'group',
                    'internal_type' => 'db',
                    'allowed' => 'fe_users',
                    'foreign_table' => 'fe_users',
                    'size' => '1',
                    'maxitems' => '1',
                    'minitems' => '0',
                    'eval' => 'int',
                    'default' => 0,
                ];
                if ($required) {
                    $config['minitems'] = 1;
                }
                break;
            case 'badgeSuggested':
                $config = [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim',
                    'renderType' => 'BadgeSuggested',
                    'readOnly' => false,
                    'default' => '',
                    'fieldInformation' => [
                        'AdditionalInfoPageTitle' => [
                            'renderType' => 'BadgeSuggested',
                        ],
                    ],
                ];
                if ($required) {
                    $config['eval'] .= ',required';
                }
                break;
        }
        if ($readonly) {
            $config['readOnly'] = true;
        }
        if (isset($options['default'])) {
            $config['default'] = $options['default'];
        }
        return $config;
    }

    /**
     * @param string $type
     * @param string $table
     * @param string $extensionKey
     * @return array<string, mixed>
     *
     * @example
     * 'columns' => [
     *     'sys_language_uid' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('sys_language_uid'),
     *     'l10n_parent' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('l10n_parent', $table, $extKey),
     *     'l10n_diffsource' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('l10n_diffsource'),
     *     't3ver_label' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('t3ver_label'),
     *     'hidden' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('hidden'),
     *     'starttime' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('starttime'),
     *     'endtime' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('endtime'),
     *     'support' => \CodingMs\AdditionalTca\Tca\ConfigurationPresetCustom::full('support', $table, $extKey),
     */
    public static function full(string $type, string $table='', string $extensionKey=''): array
    {
        $config = [];
        switch ($type) {
            case 'sys_language_uid':
                if ((int)GeneralUtility::makeInstance(Typo3Version::class)->getVersion() <= 10) {
                    $config = [
                        'exclude' => 1,
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
                        'config' => [
                            'type' => 'select',
                            'renderType' => 'selectSingle',
                            'foreign_table' => 'sys_language',
                            'foreign_table_where' => 'ORDER BY sys_language.title',
                            'default' => 0,
                            'items' => [
                                ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
                                ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
                            ],
                        ],
                    ];
                } else {
                    $config = [
                        'exclude' => 1,
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
                        'config' => [
                            'type' => 'language',
                        ],
                    ];
                }
                break;
            case 'l10n_parent':
                $config = [
                    'displayCond' => 'FIELD:sys_language_uid:>:0',
                    'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
                    'config' => [
                        'type' => 'select',
                        'renderType' => 'selectSingle',
                        'items' => [
                            ['', 0],
                        ],
                        'foreign_table' => $table,
                        'foreign_table_where' => 'AND ' . $table . '.pid=###CURRENT_PID### AND ' . $table . '.sys_language_uid IN (-1,0)',
                    ],
                ];
                break;
            case 'l10n_diffsource':
                $config = [
                    'config' => [
                        'type' => 'passthrough',
                    ],
                ];
                break;
            case 't3ver_label':
                $config = [
                    'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
                    'config' => [
                        'type' => 'input',
                        'size' => 30,
                        'max' => 255,
                    ]
                ];
                break;
            case 'hidden':
                $config = [
                    'exclude' => 1,
                    'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
                    'config' => [
                        'type' => 'check',
                    ],
                ];
                break;
            case 'starttime':
                $config = [
                    'exclude' => 1,
                    'l10n_mode' => 'mergeIfNotBlank',
                    'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
                    'config' => [
                        'type' => 'input',
                        'renderType' => 'inputDateTime',
                        'eval' => 'datetime,int',
                        'default' => 0,
                    ],
                ];
                break;
            case 'endtime':
                $config = [
                    'exclude' => 1,
                    'l10n_mode' => 'mergeIfNotBlank',
                    'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
                    'config' => [
                        'type' => 'input',
                        'renderType' => 'inputDateTime',
                        'eval' => 'datetime,int',
                        'default' => 0,
                    ],
                ];
                break;
            case 'information':
                $config = [
                    'exclude' => 0,
                    'label' => '',
                    'config' => [
                        'type' => 'user',
                        'renderType' => 'Information',
                        'userFunc' => 'CodingMs\\AdditionalTca\\Tca\\InformationRow->renderField',
                        'parameters' => [
                            'extensionKey' => $extensionKey,
                        ],
                    ]
                ];
                break;
        }
        return $config;
    }

    /**
     * @param string $type
     * @return string
     */
    public static function label(string $type): string
    {
        $label = [
            'tab_general' => 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
            'tab_language' => 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
            'tab_access' => 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
            'tab_notes' => 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes',
            'tab_extended' => 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
            'tab_seo' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_seo',
            'tab_relations' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_relations',
            'tab_images' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_images',
            'tab_files' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_files',
            'tab_links' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_links',
            'tab_markdown' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_markdown',
            'tab_contact' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_contact',
            'tab_persons' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_persons',
            'tab_bookings' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_bookings',
            'tab_prices' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_prices',
            'tab_map' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_map',
            'tab_registration' => 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_label.tab_registration',
        ];
        return $label[$type] ?? $type;
    }
}
