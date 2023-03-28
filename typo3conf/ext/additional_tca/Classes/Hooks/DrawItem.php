<?php

namespace CodingMs\AdditionalTca\Hooks;

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

use Exception;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * General draw item
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class DrawItem implements PageLayoutViewDrawItemHookInterface
{

    /**
     * @var LanguageService
     */
    public $lang;

    /**
     *
     */
    public function __construct()
    {
        $this->lang = GeneralUtility::makeInstance(LanguageService::class);
        $this->lang->init($GLOBALS['BE_USER']->uc['lang']);
    }

    /**
     * Processes the item to be rendered before the actual example content gets rendered
     * Deactivates the original example content output
     *
     * @param PageLayoutView $parentObject The parent object that triggered this hook
     * @param bool $drawItem A switch to tell the parent object, if the item still must be drawn
     * @param string $headerContent The content of the item header
     * @param string $itemContent The content of the item itself
     * @param array $row The current data row for this item
     */
    public function preProcess(PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row)
    {
        if ($row['CType'] === 'list' &&
            (
                substr($row['list_type'], 0, 7) === 'modules' ||
                substr($row['list_type'], 0, 8) === 'openimmo' ||
                substr($row['list_type'], 0, 9) === 'questions' ||
                substr($row['list_type'], 0, 10) === 'glossaries'
            )
        ) {
            if (!empty($row['pi_flexform'])) {
                $drawItem = false;
                //
                // Get the settings from flex form
                $flexformArray = GeneralUtility::xml2array($row['pi_flexform']);
                //
                // Get the flex form definition
                $flexKey = $row['list_type'] . ',' . $row['CType'];
                $flexformSource = $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds'][$flexKey];
                if (substr($flexformSource, 0, 5) === 'FILE:') {
                    $flexformSource = substr($flexformSource, 5);
                }
                $flexformSource = GeneralUtility::getFileAbsFileName($flexformSource);
                if (file_exists($flexformSource)) {
                    $flexformSource = file_get_contents($flexformSource);
                    if (is_string($flexformSource)) {
                        $flexformSource = GeneralUtility::xml2array($flexformSource);
                    }
                } else {
                    throw new Exception('Flexform definition file not found');
                }
                //
                // Build the preview table
                $itemContent .= '<table class="table table-bordered table-striped">';
                foreach ($flexformSource['sheets'] as $sheetKey => $sheet) {
                    if (isset($sheet['ROOT']['TCEforms']['sheetTitle'])) {
                        $itemContent .= '<thead>';
                        $itemContent .= '<tr>';
                        $itemContent .= '<th colspan="2">' . $this->lang->sL($sheet['ROOT']['TCEforms']['sheetTitle']) . '</th>';
                        $itemContent .= '</tr>';
                        $itemContent .= '</thead>';
                    }
                    foreach ($sheet['ROOT']['el'] as $key => $element) {

                        if (isset($flexformArray['data'][$sheetKey]['lDEF'][$key])) {
                            $value = $flexformArray['data'][$sheetKey]['lDEF'][$key]['vDEF'];
                            $config = $element['TCEforms']['config'];
                            //
                            if ($config['type'] === 'select' && $config['renderType'] === 'selectSingle') {
                                //
                                // Single select
                                $valueLabel = '';
                                foreach ($config['items'] as $item) {
                                    if ($item[1] === $value) {
                                        $valueLabel = '<span title="' . $item[1] . '">' . $this->lang->sL($item[0]) . '</span>';
                                    }
                                }
                                $itemContent .= '<tr>';
                                $itemContent .= '<td>' . $this->lang->sL($element['TCEforms']['label']) . '</td>';
                                $itemContent .= '<td>' . $valueLabel . '</td>';
                                $itemContent .= '</tr>';
                                //
                            } elseif ($config['type'] === 'select' && $config['renderType'] === 'selectMultipleSideBySide') {
                                //
                                // Multiple select
                                $values = GeneralUtility::trimExplode(',', $value, true);
                                $valueLabels = [];
                                if (isset($config['foreign_table'])) {
                                    foreach ($values as $uid) {
                                        $valueLabels[] = BackendUtility::getRecordTitle(
                                            $config['foreign_table'],
                                            BackendUtility::getRecord($config['foreign_table'], $uid)
                                        ) . ' [' . $uid. ']';
                                    }
                                    $valueLabels = implode('<br />', $valueLabels);
                                }
                                else if(isset($config['items'])) {
                                    foreach ($config['items'] as $item) {
                                        if (in_array($item[1], $values)) {
                                            $valueLabels[] = '<span title="' . $item[1] . '">' . $this->lang->sL($item[0]) . '</span>';
                                        }
                                    }
                                    $valueLabels = implode(', ', $valueLabels);
                                }
                                $itemContent .= '<tr>';
                                $itemContent .= '<td>' . $this->lang->sL($element['TCEforms']['label']) . '</td>';
                                $itemContent .= '<td>' . $valueLabels . '</td>';
                                $itemContent .= '</tr>';

                            } elseif ($config['type'] === 'check') {
                                //
                                // Checkbox
                                $itemContent .= '<tr>';
                                $itemContent .= '<td>' . $this->lang->sL($element['TCEforms']['label']) . '</td>';
                                $itemContent .= '<td><span title="' . $value . '">' . ($value ? 'yes' : 'no') . ' </span></td>';
                                $itemContent .= '</tr>';
                            } else {
                                //
                                // Simple input
                                if(trim($value) !== '') {
                                    $itemContent .= '<tr>';
                                    $itemContent .= '<td>' . $this->lang->sL($element['TCEforms']['label']) . '</td>';
                                    $itemContent .= '<td>' . $value . '</td>';
                                    $itemContent .= '</tr>';
                                }
                            }
                        }
                    }
                }
                $itemContent .= '</table>';
            }
        }
    }

}
