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

use TYPO3\CMS\Backend\Form\AbstractNode;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class Notice extends AbstractNode
{
    /**
     * Handler for single nodes
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render(): array
    {
        $result = $this->initializeResultArray();
        //
        // Identify the information type
        $type = 'none';
        $typeClasses = '';
        $styles = '';
        if (isset($this->data['parameterArray']['fieldConf']['config']['informationType'])) {
            $type = trim($this->data['parameterArray']['fieldConf']['config']['informationType']);
        }
        if ($type !== '' && $type !== 'none' && $type !== 'code') {
            $typeClasses = 'alert alert-' . $type;
            $styles .= 'margin-bottom: 0;';
        } elseif ($type === 'none') {
            $typeClasses = 'text-muted';
        }
        if (trim($this->data['parameterArray']['fieldConf']['label']) === '') {
            $styles .= 'margin-top: -16px;';
        }
        //
        // Identify the information content
        $information = 'no content!';
        $informationHtml = '';
        if (isset($this->data['parameterArray']['fieldConf']['config']['informationHtml'])) {
            $informationHtml = trim($this->data['parameterArray']['fieldConf']['config']['informationHtml']);
        }
        if ($informationHtml !== '') {
            $information = $informationHtml;
        } elseif (isset($this->data['parameterArray']['fieldConf']['config']['information'])) {
            $information = trim($this->data['parameterArray']['fieldConf']['config']['information']);
            //
            // Information is a translation value
            if (substr($information, 0, 4) === 'LLL:') {
                $information = LocalizationUtility::translate($information);
            }
        }
        if ($type === 'code') {
            $information = '<div style="border:1px solid #d1d1d1;background-color: #fff;padding:10px">' . $information . '</div>';
        }
        $result['html'] = '<div class="formengine-field-item t3js-formengine-field-item">
            <div class="form-wizards-wrap ' . $typeClasses . '" style="' . $styles . '">
                <div class="form-wizards-element">' . $information . '</div>
            </div>
        </div>';
        return $result;
    }
}
