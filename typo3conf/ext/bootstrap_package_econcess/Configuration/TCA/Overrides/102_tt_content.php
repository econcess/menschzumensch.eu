<?php

defined('TYPO3') or die('Access denied.');

$GLOBALS['TCA']['tt_content']['types']['text']['columnsOverrides']['layout']['config']['items'][2] = ['Text mit Subheader über Header', '20'];
$GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['layout']['config']['items'][2] = ['Sprachweiche / Länderauswahl', '25'];
//+3226/econcess
$GLOBALS['TCA']['tt_content']['types']['card_group']['columnsOverrides']['layout']['config']['items'][2] = ['Card Group weißer Hintergrund', '30'];
//-3226/econcess
//+3425/econcess
$GLOBALS['TCA']['tt_content']['columns']['bodytext']['l10n_mode'] = '';
$GLOBALS['TCA']['tt_content']['columns']['header']['l10n_mode'] = '';
//-3425/econcess