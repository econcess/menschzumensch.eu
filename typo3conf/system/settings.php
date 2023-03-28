<?php
return [
    'BE' => [
        'debug' => true,
        'installToolPassword' => '$argon2i$v=19$m=65536,t=16,p=1$n86SJmts7rkCGskOsWYlAA$OLpmpr1uUNnehkcPTrsfPN9GGWO4P9v35vUEUiOpElo',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8mb4',
                'dbname' => 'menscheu',
                'driver' => 'mysqli',
                'host' => '127.0.0.1',
                'password' => '',
                'port' => 3306,
                'tableoptions' => [
                    'charset' => 'utf8mb4',
                    'collate' => 'utf8mb4_unicode_ci',
                ],
                'user' => 'root',
            ],
        ],
    ],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => 'EXT:bootstrap_package/Resources/Public/Images/Backend/backend-logo.svg',
            'loginBackgroundImage' => 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-background-image.jpg',
            'loginFootnote' => '',
            'loginHighlightColor' => '',
            'loginLogo' => 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-logo.svg',
            'loginLogoAlt' => '',
        ],
        'bootstrap_package' => [
            'disableCssProcessing' => '0',
            'disableGoogleFontCaching' => '0',
            'disablePageTsBackendLayouts' => '0',
            'disablePageTsContentElements' => '0',
            'disablePageTsRTE' => '0',
            'disablePageTsTCADefaults' => '0',
            'disablePageTsTCEFORM' => '0',
            'disablePageTsTCEMAIN' => '0',
        ],
        'calendars' => [
            'extension' => [
                'updateService' => [
                    'active' => '1',
                    'email' => 'typo3@coding.ms',
                ],
            ],
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'indexed_search' => [
            'catdoc' => '/usr/bin/',
            'debugMode' => '0',
            'deleteFromIndexAfterEditing' => '1',
            'disableFrontendIndexing' => '0',
            'enableMetaphoneSearch' => '1',
            'flagBitMask' => '192',
            'fullTextDataLength' => '0',
            'ignoreExtensions' => '',
            'indexExternalURLs' => '0',
            'maxAge' => '0',
            'maxExternalFiles' => '5',
            'minAge' => '24',
            'pdf_mode' => '20',
            'pdftools' => '/usr/bin/',
            'ppthtml' => '/usr/bin/',
            'unrtf' => '/usr/bin/',
            'unzip' => '/usr/bin/',
            'useCrawlerForExternalFiles' => '0',
            'useMysqlFulltext' => '0',
            'xlhtml' => '/usr/bin/',
        ],
        'news' => [
            'advancedMediaPreview' => '1',
            'archiveDate' => 'date',
            'categoryBeGroupTceFormsRestriction' => '0',
            'categoryRestriction' => 'none',
            'contentElementPreview' => '0',
            'contentElementRelation' => '1',
            'dateTimeNotRequired' => '0',
            'hidePageTreeForAdministrationModule' => '0',
            'manualSorting' => '0',
            'prependAtCopy' => '1',
            'resourceFolderImporter' => '/news_import',
            'rteForTeaser' => '0',
            'showAdministrationModule' => '1',
            'showImporter' => '0',
            'slugBehaviour' => 'unique',
            'storageUidImporter' => '1',
            'tagPid' => '1',
        ],
        'vhs' => [
            'disableAssetHandling' => '0',
        ],
    ],
    'FE' => [
        'debug' => false,
        'disableNoCacheParameter' => true,
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'GFX' => [
        'jpg_quality' => 40,
    ],
    'LOG' => [
        'TYPO3' => [
            'CMS' => [
                'deprecations' => [
                    'writerConfiguration' => [
                        'notice' => [
                            'TYPO3\CMS\Core\Log\Writer\FileWriter' => [
                                'disabled' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'MAIL' => [
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/sbin/sendmail -t -i',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'hash' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'imagesizes' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'pages' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'rootline' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
            ],
        ],
        'devIPmask' => '',
        'displayErrors' => 1,
        'encryptionKey' => 'c7ca32de81b726499ff8cfca8f860f8512c13fafc99b18138c1c71419208fb547e2760f8eb8a3d65902cc04fd0729e6e',
        'exceptionalErrors' => 4096,
        'features' => [
            'unifiedPageTranslationHandling' => true,
            'yamlImportsFollowDeclarationOrder' => true,
        ],
        'sitename' => 'New TYPO3 site Test',
        'systemMaintainers' => [
            1,
            3,
            4,
        ],
    ],
];
