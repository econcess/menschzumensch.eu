<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'InfoniqaJobs',
            'Jobs',
            [
//+3075/econcess
				// 'Jobs' => 'list, show'
				\CodingMs\InfoniqaJobs\Controller\JobsController::class => 'list, show'
//-3075/econcess
            ],
            // non-cacheable actions
            [

            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        jobs {
                            iconIdentifier = infoniqa_jobs-plugin-jobs
                            title = Infoniqa Jobs
                            description = Display Jobs which are delivered by XML
                            tt_content_defValues {
                                CType = list
                                list_type = infoniqajobs_jobs
                            }
                        }
                    }
                    show = *
                }
           }'
        );
        // Icons
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            'infoniqa_jobs-plugin-jobs',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:infoniqa_jobs/ext_icon.svg']
        );
//+854/econcess
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
			config.pageTitleProviders {
				infoniqajobstitle {
					provider = CodingMs\InfoniqaJobs\PageTitle\EconcessPageTitleProvider
					before = record
					after = altPageTitle
				}
			}
		'));
//-854/econcess
    }
);
