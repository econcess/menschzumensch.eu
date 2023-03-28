# Sprechende URLs

## Slug-Konfiguration (ab TYPO3 9.5)

## Realurl-Konfiguration (bis TYPO3 9.5)

```php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl'] = [
    'domain.de' => [

        'fixedPostVars' => [

            'calendarConfiguration' => [
                0 => [
                    'GETvar' => 'tx_calendars_calendarslist[action]',
                    'valueMap' => [
                        'showEvent' => '',
                    ],
                    'noMatch' => 'bypass',
                ],
                1 => [
                    'GETvar' => 'tx_calendars_calendarslist[controller]',
                    'valueMap' => [],
                    'noMatch' => 'bypass',
                ],
                2 => [
                    'GETvar' => 'tx_calendars_calendarslist[event]',
                    'lookUpTable' => [
                        'table' => 'tx_calendars_domain_model_calendarevent',
                        'id_field' => 'uid',
                        'alias_field' => 'CONCAT(title, \'_\', uid)',
                        'addWhereClause' => ' AND NOT deleted',
                        'useUniqueCache' => 1,
                        'useUniqueCache_conf' => [
                            'strtolower' => 1,
                            'spaceCharacter' => '-',
                        ],
                        'languageGetVar' => 'L',
                        'languageExceptionUids' => '',
                        'languageField' => 'sys_language_uid',
                        'transOrigPointerField' => 'l10n_parent',
                        'autoUpdate' => 1,
                        'expireDays' => 180,
                    ],
                ],
            ],
            4 => 'calendarConfiguration',

            'calendarRegistrationConfiguration' => [
                0 => [
                    'GETvar' => 'tx_calendars_registration[action]',
                    'valueMap' => [
                        'showRegistration' => '',
                    ],
                    'noMatch' => 'bypass',
                ],
                1 => [
                    'GETvar' => 'tx_calendars_registration[controller]',
                    'valueMap' => [],
                    'noMatch' => 'bypass',
                ],
                2 => [
                    'GETvar' => 'tx_calendars_registration[event]',
                    'lookUpTable' => [
                        'table' => 'tx_calendars_domain_model_calendarevent',
                        'id_field' => 'uid',
                        'alias_field' => 'CONCAT(title, \'_\', uid)',
                        'addWhereClause' => ' AND NOT deleted',
                        'useUniqueCache' => 1,
                        'useUniqueCache_conf' => [
                            'strtolower' => 1,
                            'spaceCharacter' => '-',
                        ],
                        'languageGetVar' => 'L',
                        'languageExceptionUids' => '',
                        'languageField' => 'sys_language_uid',
                        'transOrigPointerField' => 'l10n_parent',
                        'autoUpdate' => 1,
                        'expireDays' => 180,
                    ],
                ],
            ],
            4 => 'calendarRegistrationConfiguration',

        ],

    ],
];
```
