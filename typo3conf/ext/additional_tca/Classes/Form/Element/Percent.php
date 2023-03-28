<?php

declare(strict_types=1);

namespace CodingMs\AdditionalTca\Form\Element;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class Percent extends AbstractFormElement
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
            $itemValue = number_format($itemValue, 2, ',', '.') . ' %';
        } else {
            $itemValue = (int)$parameterArray['itemFormElValue'];
            $itemValue = number_format($itemValue / 100, 2, ',', '.') . ' %';
        }
        $id = StringUtility::getUniqueId('formengine-input-');
        $attributes = [
            'value' => $itemValue,
            'id' => $id,
            'class' => implode(' ', [
                'form-control',
                'hasDefaultValue',
                't3js-clearable',
                't3js-percent',
                'formengine-percentelement',
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
            'TYPO3/CMS/AdditionalTca/Backend/FormEngine/Element/PercentElement' => 'function(PercentElement){PercentElement.initialize(\'' . $id . '\')}'
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
