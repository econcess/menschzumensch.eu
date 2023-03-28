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
 * FormularauswahlController
 */
//+2983/econcess
use Mwwebinare\Mwwebinare\Domain\Repository\FormularauswahlRepository;

class FormularauswahlController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
//+1117/econcess
//-1117/econcess
	protected ?FormularauswahlRepository $formularauswahlRepository = null;
	
	public function injectFormularauswahlRepository(FormularauswahlRepository $formularauswahlRepository)
	{
		$this->formularauswahlRepository = $formularauswahlRepository;
	}
//-2983/econcess
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $formularauswahls = $this->formularauswahlRepository->findAll();
        $this->view->assign('formularauswahls', $formularauswahls);
    }

    /**
     * action show
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl $formularauswahl
     * @return void
     */
    public function showAction(\Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl $formularauswahl)
    {
        $this->view->assign('formularauswahl', $formularauswahl);
    }
}
