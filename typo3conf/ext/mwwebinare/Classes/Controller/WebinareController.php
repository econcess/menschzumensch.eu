<?php
//+2980/econcess
namespace Mwwebinare\Mwwebinare\Controller;
//+1111/econcess
setlocale(LC_ALL, 'de_DE.utf8'); 
//-1111/econcess
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
//+1695/econcess
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Mwwebinare\Mwwebinare\PageTitle\EconcessPageTitleProvider;
use Mwwebinare\Mwwebinare\Domain\Repository\WebinareRepository;
use Mwwebinare\Mwwebinare\Domain\Repository\KategorienRepository;
use Mwwebinare\Mwwebinare\Domain\Repository\TermineRepository;
use Mwwebinare\Mwwebinare\Domain\Repository\RegistrationaddressRepository;

/**
 * WebinareController
 */
class WebinareController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

	protected ?WebinareRepository $webinareRepository = null;
	
	protected ?KategorienRepository $kategorienRepository = null;

	protected ?TermineRepository $termineRepository = null;	

	protected ?RegistrationaddressRepository $registrationaddressRepository = null;

	public function injectWebinareRepository(WebinareRepository $webinareRepository)
	{
		$this->webinareRepository = $webinareRepository;
	}	
	public function injectKategorienRepository(KategorienRepository $kategorienRepository)
	{
		$this->kategorienRepository = $kategorienRepository;
	}
	public function injectTermineRepository(TermineRepository $termineRepository)
	{
		$this->termineRepository = $termineRepository;
	}
	public function injectRegistrationaddressRepository(RegistrationaddressRepository $registrationaddressRepository)
	{
		$this->registrationaddressRepository = $registrationaddressRepository;
	}
//-2980/econcess
    /**
     * action listwebinare
     *
     * @return void
     */	
    public function listwebinareAction()
    {
		
		$this->contentObj = $this->configurationManager->getContentObject();
		$tt_contentUid = $this->contentObj->data['uid'];
		$this->view->assign('ttcontentuid', $tt_contentUid);
		$this->view->assign('pageId', $this->contentObj->data['pid']);
		$this->view->assign('ttheader', $this->contentObj->data['header']);
				
        $webinares = $this->webinareRepository->findAllByDate($this->contentObj->data['pages']);
		//var_dump($webinares[0]);exit;
		foreach($webinares as $key => $value) {
			$webinare =  $this->webinareRepository->findByUid($value['uid']);
//+1484/econcess
//+1699/econcess
			$webinar_slug = $value['titel'];
			$webinar_slug = strtolower($webinar_slug);
			$webinar_slug = str_replace("ä", "ae", $webinar_slug);
			$webinar_slug = str_replace("ü", "ue", $webinar_slug);
			$webinar_slug = str_replace("ö", "oe", $webinar_slug);
			$webinar_slug = str_replace("ß", "ss", $webinar_slug);
			$webinar_slug = rtrim(preg_replace('/[\-]{2,}/','-',strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $webinar_slug))),'-');
			$webinare->slug = $webinar_slug;		 
//-1484/econcess
//-1699/econcess
			 $webinares[$key]['object'] = $webinare;			
		}
		
        $this->view->assign('webinares', $webinares);
		
		$kategoriens = $this->kategorienRepository->findAll();
        $this->view->assign('kategoriens', $kategoriens);
    }

	
	
	/**
     * action listvideo
     *
     * @return void
     */
    public function listvideoAction()
    {
		
		$this->contentObj = $this->configurationManager->getContentObject();
		$tt_contentUid = $this->contentObj->data['uid'];
		$this->view->assign('ttcontentuid', $tt_contentUid);
		$this->view->assign('pageId', $this->contentObj->data['pid']);
		$this->view->assign('ttheader', $this->contentObj->data['header']);
				
        $webinares = $this->webinareRepository->findAllByVideo($this->contentObj->data['pages'], 999);
		foreach($webinares as $key => $value) {
			 $webinare =  $this->webinareRepository->findByUid($value['uid']);
			 $webinares[$key]['object'] = $webinare;
		}
		#$webinares = $this->webinareRepository->findAll();
        $this->view->assign('webinares', $webinares);
		
		$kategoriens = $this->kategorienRepository->findAll();
        $this->view->assign('kategoriens', $kategoriens);
    }
	
	/**
     * action loadmore
     *
     * @return void
     */
    public function loadmoreAction()
    {
		
		
		
		$this->contentObj = $this->configurationManager->getContentObject();
		$tt_contentUid = $this->contentObj->data['uid'];
		$this->view->assign('ttcontentuid', $tt_contentUid);
		$this->view->assign('pageId', $this->contentObj->data['pid']);
		$this->view->assign('ttheader', $this->contentObj->data['header']);
				
        $webinares = $this->webinareRepository->findAllByVideo($this->contentObj->data['pages'], 999, 4);
		foreach($webinares as $key => $value) {
			 $webinare =  $this->webinareRepository->findByUid($value['uid']);
			 $webinares[$key]['object'] = $webinare;
		}
        $this->view->assign('webinares', $webinares);
		
		$kategoriens = $this->kategorienRepository->findAll();
        $this->view->assign('kategoriens', $kategoriens);
    }
	
    /**
     * action show
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Webinare $webinare
	 * @param \Mwwebinare\Mwwebinare\Domain\Model\Termine $termine
     * @return void
     */
    public function showAction(\Mwwebinare\Mwwebinare\Domain\Model\Webinare $webinare, \Mwwebinare\Mwwebinare\Domain\Model\Termine $termine)
    {	
//+1913/econcess		
		$webinar_slug = $webinare->getTitel();
		$webinar_slug = strtolower($webinar_slug);
		$webinar_slug = str_replace("ä", "ae", $webinar_slug);
		$webinar_slug = str_replace("ü", "ue", $webinar_slug);
		$webinar_slug = str_replace("ö", "oe", $webinar_slug);
		$webinar_slug = str_replace("ß", "ss", $webinar_slug);
		$webinar_slug = rtrim(preg_replace('/[\-]{2,}/','-',strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $webinar_slug))),'-');
		$webinare->slug = $webinar_slug;
//+3705/econcess
		$webinare->path_segment = $this->configurationManager->getContentObject()->data['path_segment'];
//-3705/econcess		
//-1913/econcess			
		$this->view->assign('webinare', $webinare);
		$this->view->assign('termine', $termine);
		
		$weiteretermines = $this->termineRepository->findAllWeitereTermine($webinare->getUid(), $termine->getUid());				
        $this->view->assign('weiteretermines', $weiteretermines);
		
		$GLOBALS['TSFE']->altPageTitle = $webinare->getTitel().' '.$termine->getBeginn()->format('d.m.Y');
		$GLOBALS['TSFE']->indexedDocTitle = $webinare->getTitel().' '.$termine->getBeginn()->format('d.m.Y');
		
		$this->contentObj = $this->configurationManager->getContentObject();
		$tt_contentUid = $this->contentObj->data['uid'];
		$this->view->assign('ttcontentuid', $tt_contentUid);
		$this->view->assign('pageId', $this->contentObj->data['pid']);
		$this->view->assign('ttheader', $this->contentObj->data['header']);
		
		$webinares = $this->webinareRepository->findAllByDate($this->contentObj->data['pages']);
        $this->view->assign('webinares', $webinares);

		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('description');
		$metaTagManager->removeProperty('description');
		$webinarDescription = trim(preg_replace('/\s\s+/', ' ', strip_tags($webinare->getBeschreibung())));
		$metaTagManager->addProperty('description', $webinarDescription);
		$titleProvider = GeneralUtility::makeInstance(EconcessPageTitleProvider::class);
		$titleProvider->setTitle($webinare->getTitel().' '.$termine->getBeginn()->format('d.m.Y'));	
//+1872/econcess
		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('og:title');
		$metaTagManager->removeProperty('og:title');
		$metaTagManager->addProperty('og:title', $webinare->getTitel().' '.$termine->getBeginn()->format('d.m.Y'));
		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('twitter:title');
		$metaTagManager->removeProperty('twitter:title');
		$metaTagManager->addProperty('twitter:title', $webinare->getTitel().' '.$termine->getBeginn()->format('d.m.Y'));
//-1872/econcess		
//-1695/econcess		
    }
	
	/**
     * action createanfrage
     * 
     * @return void
     */
    public function createanfrageAction()
	{
			
		
		$args = $this->request->getArguments();
		#print_r($args);
		#exit;
		
		$this->view->assign('args', $args);
		$vorname = htmlspecialchars($args['firstName']);
		$nachname = htmlspecialchars($args['lastName']);
		$email = htmlspecialchars($args['email']);

		
		
		
	
		#print_r($args);
		#exit;
		
		if($args['message'] != '') {
			##spam
			$this->addFlashMessage('Leider ist ein Fehler aufgetreten! Sie haben das Spamschutzfeld ausgefüllt und deshalb wird Ihre Anfrage NICHT übermittelt. Falls Sie eine Browserfunktion mit "autofill" für Formulare haben, schalten Sie dies bitte ab.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
			$this->redirect('doubleoptinform');
		}
		else {
			
			$regristrationaddress = $this->registrationaddressRepository->findByUid(intval($args['addressuid']));
			$EmailTodaten = array($regristrationaddress->getEmail() => $this->settings['emailabsenderto']);
			
			/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
			$emailViewInfoniquareceiver = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
			$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		
			$templateRootPath[] = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:form_double_opt_in/Resources/Private/Templates/');
			$layoutRootPaths[] = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:form_double_opt_in/Resources/Private/Layouts/');
			$partialRootPaths[] = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:form_double_opt_in/Resources/Private/Partials/');
	
			$emailViewInfoniquareceiver->setLayoutRootPaths($layoutRootPaths);
			$emailViewInfoniquareceiver->setPartialRootPaths($partialRootPaths);
			$emailViewInfoniquareceiver->setTemplatePathAndFilename('typo3conf/ext/mwwebinare/Resources/Private/Templates/Webinare/MailanInfoniqua.html');
				
			$emailViewInfoniquareceiver->assign('args', $args);
			
			$EmailFromdaten = array($this->settings['emailabsenderemail'] => $this->settings['emailabsender']);

			$useremaildaten = array($email => $vorname.' '.$nachname);
		
			$subject = 'Anmeldung Webinar';
				
			$emailBody = $emailViewInfoniquareceiver->render();
					
			/** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
			$message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
			$message->setTo($EmailTodaten)
			->setFrom($EmailFromdaten)
			->setSubject($subject);
	
			$message->setReplyTo($useremaildaten);
		
					
			// Plain text example
			$message->setBody($emailBody, 'text/plain');
				
			// HTML Email
			$message->setBody($emailBody, 'text/html');
					
			$message->send();
			
		
			/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
			$emailViewUser = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
			$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			
			$emailViewUser->setLayoutRootPaths($layoutRootPaths);
			$emailViewUser->setPartialRootPaths($partialRootPaths);
			$emailViewUser->setTemplatePathAndFilename('typo3conf/ext/mwwebinare/Resources/Private/Templates/Webinare/Mailanuser.html');
					
			$emailViewUser->assign('args', $args);
			
			$subjectUser = 'Ihre Anmeldung zum Webinar';
	
			$emailBodyUser = $emailViewUser->render();
					
			/** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
			$messageUser = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
			$messageUser->setTo($useremaildaten)
			->setFrom($EmailFromdaten)
			->setSubject($subjectUser);
	
			$messageUser->setReplyTo($EmailTodaten);
					
			// Plain text example
			$messageUser->setBody($emailBodyUser, 'text/plain');
				
			// HTML Email
			$messageUser->setBody($emailBodyUser, 'text/html');
					
			$messageUser->send();
			#exit;



			if($messageUser->isSent() == '1') {
				if($this->settings['isajax'] == 'yes') {
					return '<div class="clr h15"></div>
							<p class="text-right"><strong>Ihre Nachricht wurde erfolgreich übermittelt!</strong></p>
							';
				}
				else {
					$uriBuilder = $this->controllerContext->getUriBuilder();
					$uriBuilder->reset();
					// specify the page ID for the link
					$uriBuilder->setTargetPageUid($this->settings['anfragelisteredirect']);

						#$uriBuilder->setArguments(array(
						#	'DoubleOptIn' => $args['newAnfrage']['doubleoptinform']
						#));
					
					$uri = $uriBuilder->build(); // ready, steady…
					#exit;
					$this->redirectToUri($uri); // …go!

					#$this->redirect('list');
				}

			}
			else {
				return 'Leider ist ein fehler bei der Übermittlung aufgetreten. Bitte kontaktieren Sie unser Büro unter <a href="mailto:'.$this->settings['emailabsenderemail'].'">'.$this->settings['emailabsenderemail'].'</a>!';
			}
		}
		

		#$hotelsForGoogleClick
    }
}
