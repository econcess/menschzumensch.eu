# Example of a simple TCA file

```php
<?php
$extKey = 'questions';
$table = 'tx_questions_domain_model_questioncategory';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;

return [
    'ctrl' => [
        'title'	=> $lll,
        'label' => 'title',
        'label_alt' => 'description',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description',
        'iconfile' => 'EXT:questions/Resources/Public/Icons/iconmonstr-help-3.svg'
    ],
    'types' => [
        '1' => ['showitem' => '
            information,
            title,
            description,
        --div--;' . \CodingMs\Questions\Tca\Configuration::label('tab_language') . ',
            sys_language_uid,
            l10n_parent,
            l10n_diffsource,
        --div--;' . \CodingMs\Questions\Tca\Configuration::label('tab_access') . ',
            hidden,
            starttime,
            endtime
        '],
    ],
    'columns' => [
        'information' =>  \CodingMs\Questions\Tca\Configuration::full('information', '', $extKey),
        'sys_language_uid'  => \CodingMs\Questions\Tca\Configuration::full('sys_language_uid'),
        'l10n_parent' => \CodingMs\Questions\Tca\Configuration::full('l10n_parent', $table),
        'l10n_diffsource' => \CodingMs\Questions\Tca\Configuration::full('l10n_diffsource'),
        't3ver_label' => \CodingMs\Questions\Tca\Configuration::full('t3ver_label'),
        'hidden' => \CodingMs\Questions\Tca\Configuration::full('hidden'),
        'title' => [
            'exclude' => 0,
            'label' => $lll . '.title',
            'config'  => \CodingMs\Questions\Tca\Configuration::get('string', true),
        ],
        'description' => [
            'exclude' => 0,
            'label' => $lll . '.description',
            'config'  => \CodingMs\Questions\Tca\Configuration::get('string'),
        ],
    ],
];
```
