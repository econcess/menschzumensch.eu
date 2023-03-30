<?php declare(strict_types=1);
namespace CodingMs\Calendars\Tca;

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

use CodingMs\AdditionalTca\Tca\Configuration as ConfigurationDefaults;

class Configuration extends ConfigurationDefaults
{

    /**
     * @param string $type
     * @param bool $required
     * @param bool $readonly
     * @param string $label
     * @param array $options
     * @return array
     */
    public static function get($type, $required = false, $readonly = false, $label = '', array $options=[]): array
    {
        switch ($type) {
            case 'calendar_event_category':
                $config = [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => 'tx_calendars_domain_model_calendareventcategory',
                    'foreign_table_where' => 'AND tx_calendars_domain_model_calendareventcategory.pid=###CURRENT_PID### AND tx_calendars_domain_model_calendareventcategory.sys_language_uid IN (-1,0) ORDER BY tx_calendars_domain_model_calendareventcategory.title',
                    'size' => 5,
                    'minitems' => 0,
                    'maxitems' => 99,
                    //'eval' => 'required'
                    'wizards' => [
                        '_PADDING' => 1,
                        '_VERTICAL' => 1,
                        'edit' => [
                            'type' => 'popup',
                            'title' => 'Edit',
                            'icon' => 'edit2.gif',
                            'popup_onlyOpenIfSelected' => 1,
                            'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                            // TYPO3 6.x style
                            'script' => 'wizard_edit.php',
                            // TYPO3 7.x style
                            'module' => [
                                'name' => 'wizard_edit'
                            ]
                        ],
                        'add' => [
                            'type' => 'script',
                            'title' => 'Create new',
                            'icon' => 'add.gif',
                            'params' => [
                                'table' => 'tx_calendars_domain_model_calendareventcategory',
                                'pid' => '###CURRENT_PID###',
                                'setValue' => 'prepend'
                            ],
                            // TYPO3 6.x style
                            'script' => 'wizard_add.php',
                            // TYPO3 7.x style
                            'module' => [
                                'name' => 'wizard_add'
                            ]
                        ],
                    ],
                ];
                break;
            case 'registration_pid':
                $config = [
                    'type' => 'group',
                    'internal_type' => 'db',
                    'allowed' => 'pages',
                    'eval' => 'int',
                    'size' => 1,
                    'maxitems' => 1,
                    'minitems' => 0,
                    'default' => 0,
                    'show_thumbs' => 1,
                    'wizards' => [
                        'suggest' => [
                            'type' => 'suggest',
                        ],
                    ],
                ];
                break;
            case 'registrations':
                $config = [
                    'type' => 'inline',
                    'foreign_field' => 'event',
                    'foreign_table' => 'tx_calendars_domain_model_calendareventregistration',
                    'maxitems' => 9999,
                    'appearance' => [
                        'collapseAll' => 1,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 0,
                        'showPossibleLocalizationRecords' => 0,
                        'showAllLocalizationLink' => 0
                    ],
                ];
                break;
            case 'files':
                $config = [
                    'type' => 'group',
                    'internal_type' => 'db',
                    'allowed' => 'sys_file_collection',
                    'foreign_table' => 'sys_file_collection',
                    'size' => '1',
                    'maxitems' => '1',
                    'minitems' => '0',
                    'eval' => '',
                    'default' => 0,
                    'fieldWizard' => [
                        'recordsOverview' => [
                            'disabled' => 0
                        ],
                        'tableList' => [
                            'disabled' => 1
                        ]
                    ],
                ];
                break;
            case 'external_link':
                $config = [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 50,
                    'max' => 1024,
                    'eval' => 'trim',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => [
                                'title' => $label,
                            ],
                        ],
                    ],
                    'softref' => 'typolink'
                ];
                break;
            case 'event':
                $config = [
                    'type' => 'group',
                    'internal_type' => 'db',
                    'allowed' => 'tx_calendars_domain_model_calendarevent',
                    'foreign_table' => 'tx_calendars_domain_model_calendarevent',
                    'size' => '1',
                    'maxitems' => '1',
                    'minitems' => '0',
                    'eval' => 'required',
                    'fieldWizard' => [
                        'recordsOverview' => [
                            'disabled' => 0
                        ],
                        'tableList' => [
                            'disabled' => 1
                        ]
                    ],
                ];
                break;
            case 'anotherCustom':
                // ...
                break;
            default:
                $config = parent::get($type, $required, $readonly, $label, $options);
                break;
        }
        if ($readonly) {
            $config['readOnly'] = true;
        }
        return $config;
    }
}

