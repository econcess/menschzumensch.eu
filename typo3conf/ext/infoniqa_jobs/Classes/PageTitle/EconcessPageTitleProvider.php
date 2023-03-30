<?php
//+853/econcess
declare(strict_types = 1);

namespace CodingMs\InfoniqaJobs\PageTitle;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EconcessPageTitleProvider extends AbstractPageTitleProvider
{
    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
//+1597/econcess	
    public function setOgTitle(string $title)
    {
		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('og:title');
		$metaTagManager->removeProperty('og:title');
		$metaTagManager->addProperty('og:title', $title);
    }	
//-1597/econcess
}
//-853/econcess