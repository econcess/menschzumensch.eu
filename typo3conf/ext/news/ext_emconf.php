<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "news".
 *
 * Auto generated 27-09-2022 13:49
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'News system',
  'description' => 'Versatile news system based on Extbase & Fluid and using the latest technologies provided by TYPO3 CMS.',
  'category' => 'fe',
  'version' => '9.4.0',
  'state' => 'stable',
  'uploadfolder' => false,
  'clearcacheonload' => true,
  'author' => 'Georg Ringer',
  'author_email' => 'mail@ringer.it',
  'author_company' => NULL,
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '10.4.13-11.9.99',
    ),
    'suggests' => 
    array (
      'rx_shariff' => '12.0.0-14.99.99',
      'numbered_pagination' => '1.0.1-1.99.99',
    ),
    'conflicts' => 
    array (
    ),
  ),
);

