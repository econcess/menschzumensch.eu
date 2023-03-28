<?php
//+1694/econcess
declare(strict_types = 1);

namespace Mwwebinare\Mwwebinare\PageTitle;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

class EconcessPageTitleProvider extends AbstractPageTitleProvider
{
    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
//-1694/econcess