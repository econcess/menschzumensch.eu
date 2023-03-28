<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Register inlineController override to add THEMES functionality
/* $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1534130226] = [
    'nodeName' => 'inline',
    'priority' => 50,
    'class' => \Econcess\NewsThemes\Backend\InlineControlContainer::class,
]; */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ec_news_sections/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig">'
);
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
   \TYPO3\CMS\Core\Imaging\IconRegistry::class
);
$identifier='ec-news-sections';
$iconRegistry->registerIcon(
   $identifier,
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:ec_news_sections/Resources/Public/Icons/ext_icon.svg']
);
