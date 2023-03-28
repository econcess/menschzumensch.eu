<?php

defined('TYPO3') || die('Access denied.');

//
// Register form engine fields
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1585222848] = [
    'nodeName' => 'Information',
    'priority' => '80',
    'class' => \CodingMs\AdditionalTca\Form\Element\Information::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1599211190] = [
    'nodeName' => 'Currency',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Currency::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1599211204] = [
    'nodeName' => 'Percent',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Percent::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1646140789] = [
    'nodeName' => 'Notice',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Notice::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1650378895] = [
    'nodeName' => 'BadgeSuggested',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\BadgeSuggested::class
];
