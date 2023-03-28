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
 * RegistrationaddressController
 */
 //+2985/econcess
use Mwwebinare\Mwwebinare\Domain\Repository\RegistrationaddressRepository;

class RegistrationaddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
//+1119/econcess
//-1119/econcess
	protected ?RegistrationaddressRepository $registrationaddressRepository = null;
	
	public function injectRegistrationaddressRepository(RegistrationaddressRepository $registrationaddressRepository)
	{
		$this->registrationaddressRepository = $registrationaddressRepository;
	}
//-2985/econcess
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $registrationaddress = $this->registrationaddressRepository->findAll();
        $this->view->assign('registrationaddress', $registrationaddress);
		
    }

    /**
     * action show
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Registrationaddress $registrationaddress
     * @return void
     */
    public function showAction(\Mwwebinare\Mwwebinare\Domain\Model\Registrationaddress $registrationaddress)
    {
        $this->view->assign('registrationaddress', $registrationaddress);
    }
}
