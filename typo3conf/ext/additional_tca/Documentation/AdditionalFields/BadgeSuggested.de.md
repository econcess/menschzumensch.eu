# Input mit Vorschlägen als Badges

Dieses Feld kann für einfache Eingabefelder verwendet werden. Durch die Verwendung dieses Feldes werden Badges unterhalb der Eingabe erstellt, wobei jedes Badge einen Wert dieses Feldes in verschiedenen Datensätzen darstellt. Jedes Badge/jeder Wert wird nur einmal angezeigt und ist anklickbar, sodass der Redakteur genau denselben Wert wiederverwenden kann, indem er nur auf das Badge klickt.

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
