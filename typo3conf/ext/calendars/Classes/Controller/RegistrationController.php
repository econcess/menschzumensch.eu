<?php

namespace CodingMs\Calendars\Controller;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use CodingMs\Calendars\Domain\Model\CalendarEventRegistration;
use CodingMs\Calendars\Domain\Repository\CalendarEventCategoryRepository;
use CodingMs\Calendars\Domain\Repository\CalendarEventRepository;
use CodingMs\Calendars\Utility\AuthorizationUtility;
use CodingMs\Calendars\Utility\BasicFileUtility;
use CodingMs\CalendarsPro\Service\ExportService;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Error\Result;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Validation\Validator\EmailAddressValidator;
use CodingMs\Calendars\Domain\Model\CalendarEvent;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;

/**
 *
 *
 * @package calendars
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @noinspection PhpUnused
 */
class RegistrationController extends ActionController
{
    /**
     * @var FrontendUser
     */
    protected $frontendUser = null;

    /**
     * @var CalendarEventRepository
     */
    protected $calendarEventRepository;

    /**
     * @param CalendarEventRepository $calendarEventRepository
     * @noinspection PhpUnused
     */
    public function injectCalendarEventRepository(CalendarEventRepository $calendarEventRepository)
    {
        $this->calendarEventRepository = $calendarEventRepository;
    }

    /**
     * @var CalendarEventCategoryRepository
     */
    protected $calendarEventCategoryRepository;

    /**
     * @param CalendarEventCategoryRepository $calendarEventCategoryRepository
     * @noinspection PhpUnused
     */
    public function injectCalendarEventCategoryRepository(CalendarEventCategoryRepository $calendarEventCategoryRepository)
    {
        $this->calendarEventCategoryRepository = $calendarEventCategoryRepository;
    }

    public function initializeAction()
    {
        // Fetch frontend user, if one is logged in
        $this->fetchFrontendUser();
        //
        // Explode field configuration
        $requiredFields = $this->settings['registration']['fields']['required'];
        $requiredFields = GeneralUtility::trimExplode(',', $requiredFields, true);
        $this->settings['registration']['fields']['required'] = array_combine($requiredFields, $requiredFields);
        //
        $availableFields = $this->settings['registration']['fields']['available'];
        $availableFields = GeneralUtility::trimExplode(',', $availableFields, true);
        $this->settings['registration']['fields']['available'] = array_combine($availableFields, $availableFields);
        // Note: array_combine for copy values in array keys as well!
        //
        // Write settings in global array, in order
        // to have formatting options in domain models as well
        $GLOBALS['EXTENSIONS']['calendars']['settings'] = $this->settings;
        parent::initializeAction();
    }

    /**
     * Display the registration form
     *
     * @return void
     * @throws NoSuchArgumentException
     * @noinspection PhpUnused
     */
    public function showRegistrationAction()
    {
        $selectedEvent = 0;
        //
        // Get all future events
        $events = $this->calendarEventRepository->findAllInFuture();
        $this->view->assign('events', $events);
        // If a special even was passed
        if ($this->request->hasArgument('event')) {
            // Get selected event
            $selectedEvent = (int)$this->request->getArgument('event');
            $checkSelectedEvent = $this->calendarEventRepository->findByIdentifier($selectedEvent);
            // Event was found and is valid
            if ($checkSelectedEvent instanceof CalendarEvent) {
                $selectedEvent = $checkSelectedEvent->getUid();
                $this->view->assign('selectedEventObject', $checkSelectedEvent);
            }
        }
        $this->view->assign('selectedEvent', $selectedEvent);
        //
        // Get frontend user and merge arguments
        $arguments = $this->request->getArguments();
        if ($this->frontendUser !== null) {
            $arguments = $this->overrideArgumentsByFrontendUser($arguments);
        }
        $this->view->assign('arguments', $arguments);
        $this->view->assign('frontendUser', $this->frontendUser);
    }

    /**
     * @todo CommandComtroller der alle Events x tage nach ablauf löscht
     */

    /**
     * @param array $arguments
     * @return array
     */
    protected function overrideArgumentsByFrontendUser(array $arguments): array
    {
        $arguments['lastName'] = $this->frontendUser->getLastName();
        $arguments['firstName'] = $this->frontendUser->getFirstName();
        $arguments['address'] = $this->frontendUser->getAddress();
        $arguments['zip'] = $this->frontendUser->getZip();
        $arguments['city'] = $this->frontendUser->getCity();
        $arguments['telephone'] = $this->frontendUser->getTelephone();
        $arguments['fax'] = $this->frontendUser->getFax();
        $arguments['email'] = $this->frontendUser->getEmail();
        return $arguments;
    }

    /**
     */
    protected function fetchFrontendUser()
    {
        if (AuthorizationUtility::frontendLoginExists()) {
            $frontendUserAuthentication = AuthorizationUtility::getFrontendUserAuthentication();
            if ($frontendUserAuthentication instanceof FrontendUserAuthentication) {
                /** @var FrontendUserRepository $frontendUserRepository */
                $frontendUserRepository = $this->objectManager->get(FrontendUserRepository::class);
                $this->frontendUser = $frontendUserRepository->findByIdentifier($frontendUserAuthentication->user['uid']);
            }
        }
    }

    /**
     * Check registration form data and send it by email
     *
     * @return void
     * @throws NoSuchArgumentException
     * @throws StopActionException
     * @throws UnsupportedRequestTypeException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     * @noinspection PhpUnused
     */
    public function saveRegistrationAction()
    {
        //
        // Get frontend user and merge arguments
        $arguments = $this->request->getArguments();
        if ($this->frontendUser !== null) {
            $arguments = $this->overrideArgumentsByFrontendUser($arguments);
        }
        //
        // Validate event
        $event = null;
        if ($this->request->hasArgument('event')) {
            $eventUid = (int)$this->request->getArgument('event');
            $event = $this->calendarEventRepository->findByIdentifier($eventUid);
        }
        if (!($event instanceof CalendarEvent)) {
            $translationKey = 'tx_calendars_message.error_please_select_an_event';
            $messages[$translationKey] = $this->translate($translationKey);
        } else if ($event->getTicketAmount() > 0 && $event->getTicketsAvailable() < 1) {
            // There are no tickets left
            $translationKey = 'tx_calendars_message.error_no_tickets_left';
            $messages[$translationKey] = $this->translate($translationKey);
        } else {
            // Validate arguments
            $messages = $this->validateRegistration($arguments);
        }
        //
        // Process registration in case of there are no error messages
        if (count($messages) === 0) {
            //
            if ($event->getTicketAmount() > 0) {
                // Decrease amount of tickets available
                $event->setTicketsAvailable($event->getTicketsAvailable() - 1);
            }
            $event->addRegistration($this->getRegistrationObject($arguments, $event));
            $this->calendarEventRepository->update($event);
            //
            // Concatenate field values for email text
            $emailText = '';
            $formFields = [];
            foreach ($this->settings['registration']['fields']['available'] as $availableField) {
                $formFields[$availableField] = '';
                if ($this->request->hasArgument($availableField)) {
                    $formFields[$availableField] = trim($this->request->getArgument($availableField));
                }
                $translationKey = 'tx_calendars_label.';
                $translationKey .= GeneralUtility::camelCaseToLowerCaseUnderscored($availableField);
                $translation = $this->translate($translationKey);
                if ($translation === null) {
                    $translation = $translationKey;
                }
                $emailText .= $translation . ': ' . $formFields[$availableField] . LF;
            }
            //
            $messageParameter = [];
            $messageParameter['formFields'] = $formFields;
            $messageParameter['emailText'] = $emailText;
            /** @var MailMessage $mail */
            $mail = GeneralUtility::makeInstance(MailMessage::class);
            // Render email body
            $message = $this->renderRegistrationEmail($event, $messageParameter);
            //
            // Sender name and mail
            $mail->setFrom($this->getEmailNameArray('from', $event));
            $mail->setTo($this->getEmailNameArray('to', $event));
            $bccEmail = $this->getEmailNameArray('bcc', $event);
            if (!empty($bccEmail)) {
                $mail->setBcc($bccEmail);
            }
            //
            // Prepare message
            $mail->setSubject(trim($this->settings['registration']['subject']));
            $mail->setBody($message);
            //
            // Add CSV file with registrations as attachment
            $data = $event->getRegistrationsArray();
            if (count($data) > 0 && ExtensionManagementUtility::isLoaded('calendars_pro')) {
                $csvString = ExportService::exportAsCsv($data, $event->getTitle(), false);
                $date = date($this->settings['formatting']['date']['format']);
                $filename = BasicFileUtility::cleanFileName($date . '_' . $event->getTitle() . '.csv');
                $mail->attach(\Swift_Attachment::newInstance($csvString, $filename, 'text/csv'));
            }
            //
            if ((bool)$mail->send()) {
                //
                // Send confirmation email to sender if enabled in settings
                if ((bool)$this->settings['registration']['enableConfirmationEmail']) {
                    /** @var MailMessage $confirmationMail */
                    $confirmationMail = GeneralUtility::makeInstance(MailMessage::class);
                    // Render email body
                    $message = $this->renderConfirmationEmail($event, $messageParameter);
                    // Sender name and mail
                    $confirmationMail->setFrom($this->getEmailNameArray('from', $event));
                    $name = $arguments['firstName'] . ' ' . $arguments['lastName'];
                    $confirmationMail->setTo($arguments['email'], $name);
                    // Prepare message
                    $confirmationMail->setSubject(trim($this->settings['registration']['subject']));
                    $confirmationMail->setBody($message);
                    $confirmationMail->send();
                }
                if((bool)$this->settings['registration']['enableRedirectAfterRegistration']) {
                    $arguments = [
                        'event' => $event->getUid()
                    ];
                    $this->redirect('showEvent', 'Calendar', null, $arguments, $this->settings['detail']['pageUid']);
                }
                else {
                    // Clear passed form data
                    $arguments = [];
                    //
                    $messageBody = '';
                    $messageTitle = $this->translate('tx_calendars_message.ok_registration_successful');
                    $this->addFlashMessage($messageBody, $messageTitle, AbstractMessage::OK);
                }
            } else {
                $messageBody = $this->translate('tx_calendars_message.send_mail_failed');
                $messageTitle = $this->translate('tx_calendars_message.error_registration_failed');
                $this->addFlashMessage($messageBody, $messageTitle, AbstractMessage::ERROR);
            }
        } else {
            $messageBody = implode(' ', $messages);
            $messageTitle = $this->translate('tx_calendars_message.error_registration_failed');
            $this->addFlashMessage($messageBody, $messageTitle, AbstractMessage::ERROR);
        }
        $this->forward('showRegistration', 'Registration', null, $arguments);
    }

    protected function getEmailNameArray($type, CalendarEvent $event): array
    {
        $email = '';
        $name = '';
        //
        if ($type === 'from') {
            $email = trim($this->settings['registration']['fromEmail']);
            $name = trim($this->settings['registration']['fromName']);
        }
        //
        if ($type === 'to') {
            $email = trim($this->settings['registration']['toEmail']);
            $name = trim($this->settings['registration']['toName']);
            // If address is different as default..
            $registrationAddress = trim($event->getRegistrationAddress());
            if (isset($this->settings['registration']['address'][$registrationAddress])) {
                $registrationAddress = $this->settings['registration']['address'][$registrationAddress];
                $email = trim($registrationAddress['toEmail']);
                $name = trim($registrationAddress['toName']);
            }
        }
        //
        if ($type === 'bcc') {
            $email = trim($this->settings['registration']['bccEmail']);
            $name = trim($this->settings['registration']['bccName']);
        }
        //
        if ($name === '') {
            $name = $email;
        }
        $array = [];
        if ($email !== '') {
            $array = [$email => $name];
        }
        return $array;
    }

    /**
     * @param array $arguments
     * @return array
     */
    protected function validateRegistration(array $arguments): array
    {
        $messages = [];
        //
        // Get required validators
        /** @var EmailAddressValidator $emailValidator */
        $emailValidator = GeneralUtility::makeInstance(EmailAddressValidator::class);
        //
        // Validate email
        if (isset($arguments['email'])) {
            $email = trim($arguments['email']);
            /** @var Result $emailValidationResult */
            $emailValidationResult = $emailValidator->validate($email);
            if ($email === '') {
                $translationKey = 'tx_calendars_message.error_please_enter_your_email';
                $messages[$translationKey] = $this->translate($translationKey);
            } else if ($emailValidationResult->hasErrors()) {
                $translationKey = 'tx_calendars_message.error_please_enter_a_valid_email';
                $messages[$translationKey] = $this->translate($translationKey);
            }
        } else {
            $translationKey = 'tx_calendars_message.error_please_enter_your_email';
            $messages[$translationKey] = $this->translate($translationKey);
        }
        //
        // Validate other fields
        foreach ($this->settings['registration']['fields']['required'] as $requiredField) {
            $translationKey = 'tx_calendars_message.error_please_enter_your_';
            $translationKey .= GeneralUtility::camelCaseToLowerCaseUnderscored($requiredField);
            $value = '';
            if (isset($arguments[$requiredField])) {
                $value = trim($arguments[$requiredField]);
            }
            if ($value === '') {
                $messages[$translationKey] = $this->translate($translationKey);
            }
        }
        return $messages;
    }

    /**
     * @param array $arguments
     * @param CalendarEvent $event
     * @return CalendarEventRegistration
     */
    protected function getRegistrationObject(array $arguments, CalendarEvent $event)
    {
        /** @var CalendarEventRegistration $registration */
        $registration = $this->objectManager->getEmptyObject(CalendarEventRegistration::class);
        if(isset($arguments['lastName'])) {
            $registration->setLastName($arguments['lastName']);
        }
        if(isset($arguments['firstName'])) {
            $registration->setFirstName($arguments['firstName']);
        }
        if(isset($arguments['address'])) {
            $registration->setAddress($arguments['address']);
        }
        if(isset($arguments['zip'])) {
            $registration->setZip($arguments['zip']);
        }
        if(isset($arguments['city'])) {
            $registration->setCity($arguments['city']);
        }
        if(isset($arguments['fax'])) {
            $registration->setFax($arguments['fax']);
        }
        if(isset($arguments['telephone'])) {
            $registration->setTelephone($arguments['telephone']);
        }
        if(isset($arguments['email'])) {
            $registration->setEmail($arguments['email']);
        }
        if(isset($arguments['message'])) {
            $registration->setMessage($arguments['message']);
        }
        $registration->setEvent($event);
        if ($this->frontendUser !== null) {
            $registration->setFrontendUser($this->frontendUser);
        }
        return $registration;
    }

    /**
     * Render the registration mail message
     * @param CalendarEvent $event
     * @param array $params
     * @return string
     */
    protected function renderRegistrationEmail(CalendarEvent $event, array $params): string
    {
        //
        // Get configuration
        $configurationType = ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK;
        $configuration = $this->configurationManager->getConfiguration($configurationType, 'Calendars');
        //
        /** @var StandaloneView $standaloneView */
        $standaloneView = $this->objectManager->get(StandaloneView::class);
        $standaloneView->setTemplateRootPaths($configuration['view']['templateRootPaths']);
        $standaloneView->setTemplate('Email/Registration');
        $standaloneView->assign('settings', $this->settings);
        $standaloneView->assign('event', $event);
        $standaloneView->assign('params', $params);
        return $standaloneView->render();
    }

    /**
     * Render the registration mail message
     * @param CalendarEvent $event
     * @param array $params
     * @return string
     */
    protected function renderConfirmationEmail(CalendarEvent $event, array $params): string
    {
        //
        // Get configuration
        $configurationType = ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK;
        $configuration = $this->configurationManager->getConfiguration($configurationType, 'Calendars');
        //
        /** @var StandaloneView $standaloneView */
        $standaloneView = $this->objectManager->get(StandaloneView::class);
        $standaloneView->setTemplateRootPaths($configuration['view']['templateRootPaths']);
        $standaloneView->setTemplate('Email/Confirmation');
        $standaloneView->assign('settings', $this->settings);
        $standaloneView->assign('event', $event);
        $standaloneView->assign('params', $params);
        return $standaloneView->render();
    }

    /**
     * @param $key
     * @param array $arguments
     * @return null|string
     */
    protected function translate($key, $arguments = [])
    {
        return LocalizationUtility::translate($key, 'Calendars', $arguments);
    }

}
