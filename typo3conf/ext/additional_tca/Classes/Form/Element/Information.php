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

use CodingMs\AdditionalTca\Service\UpdatesService;
use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Package\Exception;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Displays a row of information about extension support
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class Information extends AbstractFormElement
{

    /**
     * @var string
     */
    protected string $email = 'typo3@coding.ms';

    /**
     * @var string
     * @todo move into extension settings?!
     */
    protected string $website = 'https://www.coding.ms';

    /**
     * This is the extension key of the extension, which should be checked
     * @var string
     */
    protected string $extensionKey = 'additional_tca';

    /**
     * This is the extension key of the extension, which provides settings for modifying the displayed message.
     * In case of a free base extension, it's the pro extension
     * @var string
     */
    protected string $extensionKeyConfiguration = 'additional_tca';

    /**
     * Render a Flexible Content Element type selection field
     * Date: 2016-08-31
     *
     * @return array
     * @throws Exception
     */
    public function render(): array
    {
        // Extension key from TCA configuration
        $config = $this->data['parameterArray']['fieldConf']['config'];
        $this->extensionKey = $config['parameters']['extensionKey'];
        /**
         * @todo switch between basic and pro extension key
         */
        $this->extensionKeyConfiguration = $config['parameters']['extensionKey'];
        //
        // Update information text
        $version = ExtensionManagementUtility::getExtensionVersion($this->extensionKey);
        $result = [];
        $information = '';
        $updateMessage = UpdatesService::check($this->extensionKey, explode('.', $version));
        $key = GeneralUtility::underscoredToUpperCamelCase($this->extensionKey);
        $prefix = 'LLL:EXT:additional_tca/Resources/Private/Language/locallang.xlf:tx_additionaltca_message.';
        if (is_string($updateMessage)) {
            $translationKey = $prefix . 'info_click_for_more_information';
            $message = LocalizationUtility::translate($translationKey, $key, [$this->website]);
            $information .= '<div class="alert alert-danger"><strong>' . $updateMessage . '</strong><br />';
            $information .= $message . '<br />';
            $information .= '</div>';
        }
        // Custom configuration
        $active = true;
        $aboutThisMessage = LocalizationUtility::translate($prefix . 'info_about_this_message', $key);
        /**
         * @todo Link into extension settings
         */
        $aboutThisMessage = '&nbsp;<i>[<a href="https://www.coding.ms/update/" target="_blank">' . $aboutThisMessage . '</a>]</i>';
        if (ExtensionManagementUtility::isLoaded($this->extensionKeyConfiguration)) {
            /** @var ExtensionConfiguration $extensionConfiguration */
            $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $configuration = $extensionConfiguration->get($this->extensionKeyConfiguration);
            // If configuration was already saved to LocalConfiguration.php
            if (!empty($configuration)) {
                $active = (boolean)$configuration['extension']['updateService']['active'];
                $email = $configuration['extension']['updateService']['email'];
                if (trim($email) != '' && trim($email) != trim($this->email)) {
                    $this->email = $email;
                    $aboutThisMessage = '';
                }
            }
        }
        // Support information text
        $help = LocalizationUtility::translate($prefix . 'info_need_help_or_new_features', $key);
        $mail = LocalizationUtility::translate($prefix . 'info_mail_us', $key, [$this->email]);
        $information .= $help . '<br />' . $mail . $aboutThisMessage . '<br />';
        if (!$active) {
            $information = '';
        }
        $result['html'] = $information;
        return $result;
    }
}
