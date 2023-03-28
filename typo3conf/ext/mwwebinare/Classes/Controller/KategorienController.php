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
 * KategorienController
 */
//+2984/econcess
use Mwwebinare\Mwwebinare\Domain\Repository\KategorienRepository;

class KategorienController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
//+1118/econcess
//-1118/econcess
	protected ?KategorienRepository $kategorienRepository = null;
	
	public function injectKategorienRepository(KategorienRepository $kategorienRepository)
	{
		$this->kategorienRepository = $kategorienRepository;
	}
//-2984/econcess
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $kategoriens = $this->kategorienRepository->findAll();
        $this->view->assign('kategoriens', $kategoriens);
    }

    /**
     * action show
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Kategorien $kategorien
     * @return void
     */
    public function showAction(\Mwwebinare\Mwwebinare\Domain\Model\Kategorien $kategorien)
    {
        $this->view->assign('kategorien', $kategorien);
    }
}
