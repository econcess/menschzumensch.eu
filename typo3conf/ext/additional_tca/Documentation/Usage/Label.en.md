# Using labels

```php
return [
   'types' => [
        '1' => ['showitem' => '
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_general') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_language') . ',
            sys_language_uid,
            l10n_parent,
            l10n_diffsource,
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_access') . ',
            hidden,
            starttime,
            endtime,
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_notes') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_extended') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_seo') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_relations') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_images') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_files') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_links') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_markdown') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_contact') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_persons') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_bookings') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_prices') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_map') . ',
        --div--;' . \CodingMs\AdditionalTca\Tca\Configuration::label('tab_registration') . ',
        '],
    ],
];
```
