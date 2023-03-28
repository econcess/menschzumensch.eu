# Using custom field configuration

**EXT:questions/Classes/Tca/Configuration.php**

```php
<?php declare(strict_types=1);
namespace CodingMs\Questions\Tca;
use CodingMs\AdditionalTca\Tca\Configuration as ConfigurationDefaults;

class Configuration extends ConfigurationDefaults
{

    /**
     * @param string $type
     * @param bool $required
     * @param bool $readonly
     * @param string $label
     * @param array $options
     * @return array
     */
    public static function get($type, $required = false, $readonly = false, $label = '', array $options=[]): array
    {
        switch ($type) {
            case 'questionCategories':
                $config = [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => 'tx_questions_domain_model_questioncategory',
                    'MM' => 'tx_questions_question_questioncategory_mm',
                    'foreign_table_where' => 'ORDER BY title',
                    'size' => 10,
                    'autoSizeMax' => 30,
                    'minitems' => 1,
                    'maxitems' => 9999,
                    'multiple' => 0,
                ];
                break;
            case 'anotherCustom':
                // ...
                break;
            default:
                $config = parent::get($type, $required, $readonly, $label, $options);
                break;
        }
        if ($readonly) {
            $config['readOnly'] = true;
        }
        return $config;
    }
}
```

**Usage in your own TCA:**

```php
return [
   'columns' => [
        'category' => [
            'exclude' => 0,
            'label' => $lll . '.category',
            'config' => \CodingMs\Questions\Tca\Configuration::get('questionCategories'),
        ],
    ],
];
```
