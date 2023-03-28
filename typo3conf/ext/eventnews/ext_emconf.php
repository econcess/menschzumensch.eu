<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "eventnews".
 *
 * Auto generated 10-08-2022 14:45
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'News events',
  'description' => 'Events for news',
  'category' => 'plugin',
  'version' => '5.0.0',
  'state' => 'stable',
  'uploadfolder' => false,
  'clearcacheonload' => true,
  'author' => 'Georg Ringer',
  'author_email' => '',
  'author_company' => NULL,
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '10.4.0-11.5.99',
      'news' => '9.2.0-9.9.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
);

