<?php
declare(strict_types=1);

return [
    \CodingMs\Calendars\Domain\Model\FileReference::class => [
        'tableName' => 'sys_file_reference',
    ],
    \CodingMs\Calendars\Domain\Model\CalendarEvent::class => [
        'tableName' => 'tx_calendars_domain_model_calendarevent',
        'properties' => [
            'creationDate' => [
                'fieldName' => 'crdate'
            ],
            'modificationDate' => [
                'fieldName' => 'tstamp'
            ],
        ],
    ],
];
