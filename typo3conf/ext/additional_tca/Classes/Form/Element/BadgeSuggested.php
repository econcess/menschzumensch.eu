<?php declare(strict_types=1);

namespace CodingMs\AdditionalTca\Form\Element;

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

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use PDO;

class BadgeSuggested extends AbstractFormElement
{

    /**
     * Handler for single nodes
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render(): array
    {
        $parameterArray = $this->data['parameterArray'];
        $config = $parameterArray['fieldConf']['config'];
        //
        // Fetch badges for suggestions
        $entries = $this->fetchAllBadges(
            (int)$this->data['databaseRow']['pid'],
            $this->data['tableName'],
            $this->data['fieldName']
        );
        $marginFix = '';
        if(count($entries) && (int)GeneralUtility::makeInstance(Typo3Version::class)->getVersion() <= 10) {
            $marginFix = 'margin-bottom:-10px';
        }
        //
        $resultArray = $this->initializeResultArray();
        $config = $parameterArray['fieldConf']['config'];
        $size = MathUtility::forceIntegerInRange($config['size'] ?: $this->defaultInputWidth, $this->minimumInputWidth, $this->maxInputWidth);
        $width = (int)$this->formMaxWidth($size);
        $id = StringUtility::getUniqueId('formengine-input-');
        $attributes = [
            'name' => $parameterArray['itemFormElName'],
            'value' => $parameterArray['itemFormElValue'],
            'id' => $id,
            'class' => implode(' ', [
                'form-control',
                'hasDefaultValue',
                't3js-clearable',
                't3js-duration',
                'formengine-badge-suggested',
            ]),
            'data-formengine-validation-rules' => $this->getValidationDataAsJsonString([]),
            'data-formengine-input-params' => json_encode([
                'field' => '',
                'evalList' => '',
                'is_in' => '',
            ]),
            'data-formengine-input-name' => $parameterArray['itemFormElName'],
        ];
        //
        // Is read only?!
        if (isset($config['readOnly']) && $config['readOnly']) {
            $attributes['readonly'] = 'readonly';
            $attributes['class'] = str_replace('t3js-clearable', '', $attributes['class']);
        }
        //
        // HTML
        $html = [];
        $html[] = '<div class="formengine-field-item t3js-formengine-field-item">';
        $html[] = '<div class="form-wizards-wrap">';
        $html[] = '<div class="form-wizards-element">';
        $html[] = '<div class="form-control-wrap" style="max-width: ' . $width . 'px;' . $marginFix . '">';
        $html[] = '<input type="text"' . GeneralUtility::implodeAttributes($attributes, true) . ' />';
        if (count($entries) > 0) {
            $html[] = '<div class="form-wizards-element-scopes">';
            foreach ($entries as $entry) {
                $html[] = '<a class="badge" onclick="document.getElementById(\'' . $id . '\').value = this.innerHTML;return false;" href="#" style="border-radius: 2px">' . $entry . '</a>';
            }
            $html[] = '</div>';
        }
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';
        $resultArray['html'] = implode(LF, $html);
        return $resultArray;
    }

    /**
     * @param int $pageUid
     * @param string $table
     * @param string $field
     * @return array
     */
    public function fetchAllBadges($pageUid, $table, $field): array
    {
        $badges = [];
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable($table);
        $queryBuilder->select($field)
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq(
                    'pid',
                    $queryBuilder->createNamedParameter($pageUid, PDO::PARAM_INT)
                )
            );
        $records = $queryBuilder->execute()->fetchAll();
        foreach ($records as $record) {
            $badges[$record[$field]] = $record[$field];
        }
        sort($badges);
        return $badges;
    }

}
