<?php
defined('TYPO3') or die('Access denied.');
/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['bootstrap_package_econcess'] = 'EXT:bootstrap_package_econcess/Configuration/RTE/Default.yaml';

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_package_econcess/Configuration/TsConfig/Page/All.tsconfig">');
$GLOBALS['TYPO3_CONF_VARS']['FE']['cookieDomain'] = 'entwicklung.infoniqa.com';