<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Mwwebinare.Mwwebinare',
            'Mwlistwebinare',
            'Liste Webinare'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Mwwebinare.Mwwebinare',
            'Mwlistvideo',
            'Liste Webinare Video'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Mwwebinare.Mwwebinare',
            'Mwlistexperten',
            'Liste Experten'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Mwwebinare.Mwwebinare',
            'Mwfaq',
            'Webinare FAQ'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('mwwebinare', 'Configuration/TypoScript', 'Infoniqa Webinare');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mwwebinare_domain_model_webinare', 'EXT:mwwebinare/Resources/Private/Language/locallang_csh_tx_mwwebinare_domain_model_webinare.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mwwebinare_domain_model_webinare');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mwwebinare_domain_model_kategorien', 'EXT:mwwebinare/Resources/Private/Language/locallang_csh_tx_mwwebinare_domain_model_kategorien.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mwwebinare_domain_model_kategorien');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mwwebinare_domain_model_termine', 'EXT:mwwebinare/Resources/Private/Language/locallang_csh_tx_mwwebinare_domain_model_termine.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mwwebinare_domain_model_termine');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mwwebinare_domain_model_registrationaddress', 'EXT:mwwebinare/Resources/Private/Language/locallang_csh_tx_mwwebinare_domain_model_registrationaddress.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mwwebinare_domain_model_registrationaddress');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mwwebinare_domain_model_formularauswahl', 'EXT:mwwebinare/Resources/Private/Language/locallang_csh_tx_mwwebinare_domain_model_formularauswahl.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mwwebinare_domain_model_formularauswahl');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mwwebinare_domain_model_experten', 'EXT:mwwebinare/Resources/Private/Language/locallang_csh_tx_mwwebinare_domain_model_experten.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mwwebinare_domain_model_experten');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mwwebinare_domain_model_faq', 'EXT:mwwebinare/Resources/Private/Language/locallang_csh_tx_mwwebinare_domain_model_faq.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mwwebinare_domain_model_faq');

    }
);
//+1718/econcess
//$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('mwwebinare'));
$pluginName = strtolower('Mwlistwebinare');
$pluginSignature = $extensionName.'_'.$pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = '';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/WebinarAction.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.'mwwebinare'. '/Configuration/FlexForms/WebinarAction.xml');
//-1718/econcess