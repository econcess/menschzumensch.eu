<?php

declare(strict_types=1);

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class Currency extends AbstractFormElement
{
    /**
     * Handler for single nodes
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render(): array
    {
        $languageService = $this->getLanguageService();
        $table = $this->data['tableName'];
        $fieldName = $this->data['fieldName'];
        $row = $this->data['databaseRow'];
        $parameterArray = $this->data['parameterArray'];
        $resultArray = $this->initializeResultArray();
        $config = $parameterArray['fieldConf']['config'];
        $size = MathUtility::forceIntegerInRange($config['size'] ?: $this->defaultInputWidth, $this->minimumInputWidth, $this->maxInputWidth);
        $width = (int)$this->formMaxWidth($size);
        if ($config['dbType'] === 'float') {
            $itemValue = (float)$parameterArray['itemFormElValue'];
            $itemValue = number_format($itemValue, 2, ',', '.') . ' €';
        } else {
            $itemValue = (int)$parameterArray['itemFormElValue'];
            $itemValue = number_format($itemValue/100, 2, ',', '.') . ' €';
        }
        $id = StringUtility::getUniqueId('formengine-input-');
        $attributes = [
            'value' => $itemValue,
            'id' => $id,
            'class' => implode(' ', [
                'form-control',
                'hasDefaultValue',
                't3js-clearable',
                't3js-currency',
                'formengine-currencyelement',
            ]),
            'data-formengine-validation-rules' => $this->getValidationDataAsJsonString([]), //$config),
            'data-formengine-input-params' => json_encode([
                'field' => '',
                'evalList' => '',
                'is_in' => '',
            ]),
            'data-formengine-input-name' => $parameterArray['itemFormElName'],
            'data-db-type' => ($config['dbType'] === 'float') ? 'float' : 'int',
        ];
        //
        // Is read only?!
        if (isset($config['readOnly']) && $config['readOnly']) {
            $attributes['readonly'] = 'readonly';
            $attributes['class'] = str_replace('t3js-clearable', '', $attributes['class']);
        }
        //
        // Load needed js library
        $resultArray['requireJsModules'][] = [
            'TYPO3/CMS/AdditionalTca/Backend/FormEngine/Element/CurrencyElement' => 'function(CurrencyElement){CurrencyElement.initialize(\'' . $id . '\')}'
        ];
        //
        // HTML
        $html = [];
        $html[] = '<div class="formengine-field-item t3js-formengine-field-item">';
        $html[] =   '<div class="form-wizards-wrap">';
        $html[] =       '<div class="form-wizards-element">';
        $html[] =           '<div class="form-control-wrap" style="max-width: ' . $width . 'px">';
        $html[] =          '<input type="text"' . GeneralUtility::implodeAttributes($attributes, true) . ' />';
        $html[] =          '<input type="hidden" readonly="readonly" name="' . $parameterArray['itemFormElName'] . '" value="' . htmlspecialchars($itemValue) . '" id="' . $id . '_hidden" />';
        $html[] =       '</div>';
        $html[] =       '</div>';
        $html[] =   '</div>';
        $html[] = '</div>';
        $resultArray['html'] = implode(PHP_EOL, $html);
        return $resultArray;
    }
}
