# Input with suggestions as badges

This field can be used for simple input fields. By using this field there will be created badges below the input, where each badge represented a value of this field in different records. Each badge/value is only displayed once and is clickable, so that the editor is able to reuse exactly the same value only by clicking the badge.

![Input with suggestions as badges](https://www.coding.ms/fileadmin/extensions/additional_tca/current/Documentation/Images/BadgeSuggested.png)


## Definition

```php
$extKey = 'shop';
$table = 'tx_shop_domain_model_product';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        'internal_notice' => [
            'exclude' => false,
            'label' => $lll . '.internal_notice',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('badgeSuggested', false, false, ''),
        ],
    ],
];
```
