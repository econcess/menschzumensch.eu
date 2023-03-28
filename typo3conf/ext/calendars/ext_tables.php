<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'calendars',
    'CalendarList',
    'Calendar - Liste/Details (nur zukünftige Termine)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'calendars',
    'CalendarMonth',
    'Calendar - Monats-Widget'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'calendars',
    'Registration',
    'Calendar - Event-Anmeldung'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'calendars',
    'CalendarFullYear',
    'Calendar - Jahres-Übersicht'
);


// Include flex forms
$pluginName = 'CalendarList'; // siehe Tx_Extbase_Utility_Extension::registerPlugin
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('calendars');
$pluginSignature = strtolower($extensionName) . '_' . strtolower($pluginName);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:calendars/Configuration/FlexForms/CalendarList.xml');
// CSH for FlexForm
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tt_content.pi_flexform.' . $pluginSignature . '.list',
    'EXT:calendars/Resources/Private/Language/locallang_plugin_calendarlist.xlf'
);

$pluginName = 'CalendarMonth'; // siehe Tx_Extbase_Utility_Extension::registerPlugin
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('calendars');
$pluginSignature = strtolower($extensionName) . '_' . strtolower($pluginName);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:calendars/Configuration/FlexForms/CalendarMonth.xml');
// CSH for FlexForm
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tt_content.pi_flexform.' . $pluginSignature . '.list',
    'EXT:calendars/Resources/Private/Language/locallang_plugin_calendarmonth.xlf'
);

$pluginName = 'Registration'; // siehe Tx_Extbase_Utility_Extension::registerPlugin
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('calendars');
$pluginSignature = strtolower($extensionName) . '_' . strtolower($pluginName);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:calendars/Configuration/FlexForms/Registration.xml');
// CSH for FlexForm
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tt_content.pi_flexform.' . $pluginSignature . '.list',
    'EXT:calendars/Resources/Private/Language/locallang_csh_flexform_registration.xlf'
);

$pluginName = 'CalendarFullYear'; // siehe Tx_Extbase_Utility_Extension::registerPlugin
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('calendars');
$pluginSignature = strtolower($extensionName) . '_' . strtolower($pluginName);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:calendars/Configuration/FlexForms/CalendarFullYear.xml');
// CSH for FlexForm
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tt_content.pi_flexform.' . $pluginSignature . '.list',
    'EXT:calendars/Resources/Private/Language/locallang_plugin_calendarfullyear.xlf'
);
//
// TypoScript
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('calendars', 'Configuration/TypoScript', 'Calendar');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('calendars', 'Configuration/TypoScript/Stylesheet', 'Calendar - Default stylesheets');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('calendars', 'Configuration/TypoScript/YearCalendar', 'Calendar - Year calendar scripts');
//
// Page type
if (TYPO3_MODE === 'BE') {
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Imaging\\IconRegistry');
    $iconRegistry->registerIcon(
        'apps-pagetree-folder-contains-calendar',
        'TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider',
        ['source' => 'EXT:calendars/Resources/Public/Icons/iconmonstr-calendar-4.svg']
    );
    $GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
        0 => 'LLL:EXT:calendars/Resources/Private/Language/locallang_db.xlf:tx_calendars_label.contains_calendar',
        1 => 'calendar',
        2 => 'apps-pagetree-folder-contains-calendar'
    ];
    $GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-calendar'] = 'apps-pagetree-folder-contains-calendar';
}
//
// register svg icons: identifier and filename
$iconsSvg = [
    'mimetypes-x-content-calendars-calendarevent' => 'Resources/Public/Icons/iconmonstr-calendar-9.svg',
    'mimetypes-x-content-calendars-calendareventcategory' => 'Resources/Public/Icons/iconmonstr-link-2.svg',
    'icon-content-plugin-calendars-calendarfullyear' => 'Resources/Public/Icons/iconmonstr-calendar-4.svg',
    'icon-content-plugin-calendars-calendarlist' => 'Resources/Public/Icons/iconmonstr-calendar-4.svg',
    'icon-content-plugin-calendars-calendarmonth' => 'Resources/Public/Icons/iconmonstr-calendar-4.svg',
    'icon-content-plugin-calendars-eventregistration' => 'Resources/Public/Icons/iconmonstr-calendar-6.svg',
];
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($iconsSvg as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:calendars/' . $path]
    );
}
//
// Table configuration arrays
$tables = [
    'tx_calendars_domain_model_calendarevent' => [
        'csh' => 'EXT:calendars/Resources/Private/Language/locallang_csh_calendarevent.xlf'
    ],
    'tx_calendars_domain_model_calendareventcategory' => [
        'csh' => 'EXT:calendars/Resources/Private/Language/locallang_csh_calendareventcategory.xlf'
    ],
    'tx_calendars_domain_model_calendareventregistration' => [
        'csh' => 'EXT:calendars/Resources/Private/Language/locallang_csh_calendarregistration.xlf'
    ],
];
foreach ($tables as $table => $data) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr($table, $data['csh']);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages($table);
}
