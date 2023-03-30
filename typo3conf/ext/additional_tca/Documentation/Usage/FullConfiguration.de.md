# Verwendung der vollständigen Konfigurationen

```php
return [
   'columns' => [
        'information' => \CodingMs\AdditionalTca\Tca\Configuration::full('information', $table, $extKey),
        'sys_language_uid' => \CodingMs\AdditionalTca\Tca\Configuration::full('sys_language_uid'),
        'l10n_parent' => \CodingMs\AdditionalTca\Tca\Configuration::full('l10n_parent', $table),
        'l10n_diffsource' => \CodingMs\AdditionalTca\Tca\Configuration::full('l10n_diffsource'),
        't3ver_label' => \CodingMs\AdditionalTca\Tca\Configuration::full('t3ver_label'),
        'hidden' => \CodingMs\AdditionalTca\Tca\Configuration::full('hidden'),
        'starttime' => \CodingMs\AdditionalTca\Tca\Configuration::full('starttime'),
        'endtime' => \CodingMs\AdditionalTca\Tca\Configuration::full('endtime'),
    ],
];
```
