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
 * TermineController
 */
//+2986/econcess
use Mwwebinare\Mwwebinare\Domain\Repository\TermineRepository;

class TermineController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
//+1116/econcess
//-1116/econcess
	protected ?TermineRepository $termineRepository = null;
	
	public function injectTermineRepository(TermineRepository $termineRepository)
	{
		$this->termineRepository = $termineRepository;
	}
//-2986/econcess
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $termines = $this->termineRepository->findAll();
        $this->view->assign('termines', $termines);
    }

    /**
     * action show
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Termine $termine
     * @return void
     */
    public function showAction(\Mwwebinare\Mwwebinare\Domain\Model\Termine $termine)
    {
        $this->view->assign('termine', $termine);
    }
}
