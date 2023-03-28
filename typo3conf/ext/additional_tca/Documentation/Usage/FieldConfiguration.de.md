# Verwendung der Feldkonfiguration


```php
$extKey = 'shop';
$table = 'tx_shop_domain_model_product';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        //
        // Each field can have an options.default to set the default value
        //
        'slug' => [
            // field: ... -> Database field for auto generate the slug
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('slug', false, false, '', ['field' => 'answer']),
        ],
        'rte' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('rte'),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled]',
        ],
        'textareaSmall' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('textareaSmall'),
        ],
        'textareaLarge' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('textareaLarge'),
        ],
        'markdown' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('markdown'),
            'defaultExtras' => 'fixed-font:enable-tab',
        ],
        'html' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('html'),
            'defaultExtras' => 'fixed-font:enable-tab',
        ],
        'int' => [
            // lower:, upper: enter range for integer, set both or none (not just one)
            // without these -> user can enter any integer
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('int', false, false, '', ['lower' => 1, 'upper' => 50]),
        ],
        'coordinate' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('coordinate'),
        ],
        'currency' => [
            // dbType: float -> Database field is a float number
            // without dbType -> Database field is an integer number
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('currency', false, false, '', ['dbType' => 'float']),
        ],
        'percent' => [
            // dbType: float -> Database field is a float number
            // without dbType -> Database field is an integer number
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('percent', false, false, '', ['dbType' => 'float']),
        ],
        'string' => [
            // options.default = 'default value'
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'email' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('email'),
        ],
        'color' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('color'),
        ],
        'checkbox' => [
            // Checkbox label can be assigned as LLL as well
            // For example:
            // get('checkbox', false, false, $lll . '.in_stock_label')
            // get('checkbox', false, false, 'LLL:EXT:locallang.xlf:in_stock_label')
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('checkbox', false, false, 'Checkbox label'),
        ],
        'link' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get(
                'link',
                false,
                false,
                $lll . '.canonical_link',
                [
                    'title' => $lll . '.canonical_link',
                    'blindLinkFields' => 'class,target,title',
                    // Possible values: file, folder, mail, page, spec, telephone and url
                    'blindLinkOptions' => 'mail,folder,file,telephone,shop_product,url,news_news'
                ]
            ),
        ],
        'date' => [
            // dbType: timestamp -> Database field is an integer for timestamps
            // without dbType -> Database field is a date string
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('date', false, false, '', ['dbType' => 'timestamp']),
        ],
        'dateTime' => [
            // dbType: timestamp -> Database field is an integer for timestamps
            // without dbType -> Database field is a date string
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('dateTime', false, false, '', ['dbType' => 'timestamp']),
        ],
        'select' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('select', true, false, '', [
                [$lll . '.template_default', 'Default'],
                [$lll . '.template_with_single_view', 'WithSingleView'],
            ]),
        ],
        'fileSingle' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('fileSingle', false, false, '', ['field' => 'fileSingle']),
        ],
        'fileCollectionSingleInline' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('fileCollectionSingleInline'),
        ],
        'imageSingleAltTitle' => [
            // field: ... -> Database field for foreign_match_fields.fieldname
            // table: ... -> Database field for foreign_match_fields.tablenames
            // fileTypes: Defines the allowed file types (default: png,jpg,jpeg)
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('imageSingleAltTitle', false, false, '', ['field' => 'image', 'table' => 'tx_openimmo_domain_model_anhang', 'fileTypes' => 'png,jpg,jpeg,svg']),
        ],
        'imageSingleTitleDescription' => [
            // field: ... -> Database field for foreign_match_fields.fieldname
            // table: ... -> Database field for foreign_match_fields.tablenames
            // fileTypes: Defines the allowed file types (default: png,jpg,jpeg)
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('imageSingleTitleDescription', false, false, '', ['field' => 'image', 'table' => 'tx_openimmo_domain_model_anhang', 'fileTypes' => 'png,jpg,jpeg,svg']),
        ],
        'images' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('images', false, false, '', ['field' => 'image']),
        ],
        'frontendUserSingle' => [
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('frontendUserSingle'),
        ],
        //
        // Notices/Information
        //
        // As simple text, without headline, with LLL value
        'additional_field_description' => [
            'exclude' => 0,
            'label' => '',
            'config' => [
                'type' => 'user',
                'renderType' => 'Notice',
                'information' => $lll . '.additional_field_description',
            ],
        ],
        //
        // An error text, the informationType is the bootstrap alert-class
        // Types: danger, warning, info, success, code
        'important_message' => [
            'exclude' => 0,
            'label' => '',
            'config' => [
                'type' => 'user',
                'renderType' => 'Notice',
                'information' => 'Without LLL value!!!',
                'informationType' => 'danger',
            ],
        ],
        'badge_suggested' => [
            // An input field, which show badges belo the field.
            // These badges are values which are used in other records in this field.
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('badgeSuggested', false, false, ''),
        ],
    ],
];
```
