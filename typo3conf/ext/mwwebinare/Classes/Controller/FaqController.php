<?php
namespace Mwwebinare\Mwwebinare\Controller;

/***
 *
 * This file is part of the "Infoniqa Webinare" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Martin Weymayer <office@weymayer.at>, Webagentur Weymayer
 *
 ***/

/**
 * FaqController
 */
//+2982/econcess
use Mwwebinare\Mwwebinare\Domain\Repository\FaqRepository;

class FaqController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
//+1120/econcess
//-1120/econcess
	protected ?FaqRepository $faqRepository = null;
	
	public function injectFaqRepository(FaqRepository $faqRepository)
	{
		$this->faqRepository = $faqRepository;
	}
//-2982/econcess
    /**
     * action listfaq
     *
     * @return void
     */
    public function listfaqAction()
    {
        $faqs = $this->faqRepository->findAll();
        $this->view->assign('faqs', $faqs);
		
		$this->contentObj = $this->configurationManager->getContentObject();
		$tt_contentUid = $this->contentObj->data['uid'];
		$this->view->assign('ttcontentuid', $tt_contentUid);
		$this->view->assign('pageId', $this->contentObj->data['pid']);
		$this->view->assign('ttheader', $this->contentObj->data['header']);
    }

    /**
     * action show
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Faq $faq
     * @return void
     */
    public function showAction(\Mwwebinare\Mwwebinare\Domain\Model\Faq $faq)
    {
        $this->view->assign('faq', $faq);
    }
}
