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
 * ExpertenController
 */
//+2981/econcess
use Mwwebinare\Mwwebinare\Domain\Repository\ExpertenRepository;
 
class ExpertenController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
//+1121/econcess
//-1121/econcess
	protected ?ExpertenRepository $expertenRepository = null;
	
	public function injectExpertenRepository(ExpertenRepository $expertenRepository)
	{
		$this->expertenRepository = $expertenRepository;
	}
//-2981/econcess	
    /**
     * action listexperten
     *
     * @return void
     */
    public function listexpertenAction()
    {
        $expertens = $this->expertenRepository->findAll();
        $this->view->assign('expertens', $expertens);
		
		$this->contentObj = $this->configurationManager->getContentObject();
		$tt_contentUid = $this->contentObj->data['uid'];
		$this->view->assign('ttcontentuid', $tt_contentUid);
		$this->view->assign('pageId', $this->contentObj->data['pid']);
		$this->view->assign('ttheader', $this->contentObj->data['header']);
    }

    /**
     * action show
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Experten $experten
     * @return void
     */
    public function showAction(\Mwwebinare\Mwwebinare\Domain\Model\Experten $experten)
    {
        $this->view->assign('experten', $experten);
    }
}
