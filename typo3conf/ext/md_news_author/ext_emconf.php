<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "md_news_author".
 *
 * Auto generated 17-11-2022 15:02
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'News Author',
  'description' => 'Adds one or more authors to a tx_news record, show a list of all authors and display a detail page of the author containing the attached news entries.',
  'category' => 'plugin',
  'version' => '6.0.7',
  'state' => 'stable',
  'uploadfolder' => false,
  'clearcacheonload' => false,
  'author' => 'Christoph Daecke',
  'author_email' => 'typo3@mediadreams.org',
  'author_company' => NULL,
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '10.4.0-11.5.99',
      'news' => '7.0-9.99',
      'numbered_pagination' => '1.0.1-1.99.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
);

