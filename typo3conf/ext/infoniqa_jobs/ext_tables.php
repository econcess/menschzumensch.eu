<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {
        // Plugin
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'InfoniqaJobs',
            'Jobs',
            'Jobs'
        );
        // Flex form
        $pluginName = 'Jobs';
        $extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('infoniqa_jobs');
        $pluginSignature = strtolower($extensionName) . '_'.strtolower($pluginName);
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//+3074/econcess
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:infoniqa_jobs/Configuration/FlexForms/Jobs.xml');
//-3074/econcess
        // Static template
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('infoniqa_jobs', 'Configuration/TypoScript', 'Infoniqa Jobs');

    }
);
