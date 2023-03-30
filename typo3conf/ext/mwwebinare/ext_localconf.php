<?php
//+2978/econcess
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'mwwebinare',
            'Mwlistwebinare',
            [
                \Mwwebinare\Mwwebinare\Controller\WebinareController::class => 'listwebinare, show, createanfrage',
                \Mwwebinare\Mwwebinare\Controller\KategorienController::class => 'list, show',
                \Mwwebinare\Mwwebinare\Controller\TermineController::class => 'list, show',
				\Mwwebinare\Mwwebinare\Controller\FormularauswahlController::class => 'list, show',
                \Mwwebinare\Mwwebinare\Controller\ExpertenController::class => 'list, show',
                \Mwwebinare\Mwwebinare\Controller\FaqController::class => 'list, show'
            ],
            // non-cacheable actions
            [
                \Mwwebinare\Mwwebinare\Controller\WebinareController::class => 'createanfrage',
                'Kategorien' => '',
                'Termine' => '',
                'Formularauswahl' => '',
                'Experten' => '',
                'Faq' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'mwwebinare',
            'Mwlistvideo',
            [
                \Mwwebinare\Mwwebinare\Controller\WebinareController::class => 'listvideo, showvideo, loadmore',
                \Mwwebinare\Mwwebinare\Controller\KategorienController::class => 'list, show',
                \Mwwebinare\Mwwebinare\Controller\TermineController::class => 'list, show',
				\Mwwebinare\Mwwebinare\Controller\FormularauswahlController::class => 'list, show',
                \Mwwebinare\Mwwebinare\Controller\ExpertenController::class => 'list, show',
                \Mwwebinare\Mwwebinare\Controller\FaqController::class => 'list, show'
            ],
            // non-cacheable actions
            [
                \Mwwebinare\Mwwebinare\Controller\WebinareController::class => 'loadmore',
                'Kategorien' => '',
                'Termine' => '',
                'Formularauswahl' => '',
                'Experten' => '',
                'Faq' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'mwwebinare',
            'Mwlistexperten',
            [
                \Mwwebinare\Mwwebinare\Controller\ExpertenController::class => 'listexperten, showexperten',
                \Mwwebinare\Mwwebinare\Controller\FaqController::class => 'list, show'
            ],
            // non-cacheable actions
            [
                'Webinare' => '',
                'Kategorien' => '',
                'Termine' => '',
                'Formularauswahl' => '',
                'Experten' => '',
                'Faq' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'mwwebinare',
            'Mwfaq',
            [
                \Mwwebinare\Mwwebinare\Controller\FaqController::class => 'listfaq, showfaq'
            ],
            // non-cacheable actions
            [
                'Webinare' => '',
                'Kategorien' => '',
                'Termine' => '',
                'Formularauswahl' => '',
                'Experten' => '',
                'Faq' => ''
            ]
        );
//-2978/econcess
    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    mwlistwebinare {
                        iconIdentifier = mwwebinare-plugin-mwlistwebinare
                        title = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwlistwebinare.name
                        description = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwlistwebinare.description
                        tt_content_defValues {
                            CType = list
                            list_type = mwwebinare_mwlistwebinare
                        }
                    }
                    mwlistvideo {
                        iconIdentifier = mwwebinare-plugin-mwlistvideo
                        title = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwlistvideo.name
                        description = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwlistvideo.description
                        tt_content_defValues {
                            CType = list
                            list_type = mwwebinare_mwlistvideo
                        }
                    }
                    mwlistexperten {
                        iconIdentifier = mwwebinare-plugin-mwlistexperten
                        title = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwlistexperten.name
                        description = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwlistexperten.description
                        tt_content_defValues {
                            CType = list
                            list_type = mwwebinare_mwlistexperten
                        }
                    }
                    mwfaq {
                        iconIdentifier = mwwebinare-plugin-mwfaq
                        title = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwfaq.name
                        description = LLL:EXT:mwwebinare/Resources/Private/Language/locallang_db.xlf:tx_mwwebinare_mwfaq.description
                        tt_content_defValues {
                            CType = list
                            list_type = mwwebinare_mwfaq
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'mwwebinare-plugin-mwlistwebinare',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:mwwebinare/Resources/Public/Icons/user_plugin_mwlistwebinare.svg']
			);
		
			$iconRegistry->registerIcon(
				'mwwebinare-plugin-mwlistvideo',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:mwwebinare/Resources/Public/Icons/user_plugin_mwlistvideo.svg']
			);
		
			$iconRegistry->registerIcon(
				'mwwebinare-plugin-mwlistexperten',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:mwwebinare/Resources/Public/Icons/user_plugin_mwlistexperten.svg']
			);
		
			$iconRegistry->registerIcon(
				'mwwebinare-plugin-mwfaq',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:mwwebinare/Resources/Public/Icons/user_plugin_mwfaq.svg']
			);
//+1693/econcess
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
		config.pageTitleProviders {
			mwwebinaretitle {
				provider = Mwwebinare\Mwwebinare\PageTitle\EconcessPageTitleProvider
				before = record
				after = altPageTitle
			}
		}
	'));
//-1693/econcess		
    }
);
