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

use CodingMs\Calendars\Domain\Model\CalendarEvent;
use CodingMs\Calendars\Domain\Repository\CalendarEventRepository;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * JsonApiController
 */
class JsonApiController extends ActionController
{
    /**
     * @var \TYPO3\CMS\Extbase\Mvc\View\JsonView
     */
    protected $view;

    /**
     * @var string
     */
    protected $defaultViewObjectName = JsonView::class;

    /**
     * @var CalendarEventRepository
     */
    protected $calendarEventRepository;

    /**
     * @param CalendarEventRepository $calendarEventRepository
     */
    public function injectCalendarEventRepository(CalendarEventRepository $calendarEventRepository)
    {
        $this->calendarEventRepository = $calendarEventRepository;
    }

    /**
     * @var array
     */
    protected $json = array('messages' => array());

    /**
     * Remind filter settings
     * @return string
     */
    public function selectAction()
    {

        // von, bis,

        $events = $this->calendarEventRepository->findAll();
        // Configuration for popover rendering
        $configurationTypeFramework = ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK;
        $configuration = $this->configurationManager->getConfiguration($configurationTypeFramework, 'Calendars');
        /** @var CalendarEvent $event */
        foreach($events as $event) {
            $popoverView = new StandaloneView();
            $popoverView->setPartialRootPaths($configuration['view']['partialRootPaths']);
            $variables = ['settings' => $this->settings, 'event' => $event];
            $popover = $popoverView->renderPartial('Calendar/Popover', 'Default', $variables);
            $this->json['events'][] = [
                'id' => $event->getUid(),
                'name' => $event->getTitle(),
                'subtitle' => $event->getSubtitle(),
                'startDate' => $this->transformDateFormYearCalendar($event->getStartDate(), 'start') * 1000,
                'endDate' => $this->transformDateFormYearCalendar($event->getEndDate(), 'end') * 1000,
                'variants' => $event->getCalendarEventCategoryVariants(),
                'popover' => $popover
            ];
        }
        return json_encode($this->json);
    }

    protected function transformDateFormYearCalendar(\DateTime $date, $startEnd='start') {
        $year = (int)$date->format('Y');
        $month = (int)$date->format('m');
        $day = (int)$date->format('d');
        if($startEnd === 'start') {
            $timestamp = mktime(0, 0, 0, $month, $day, $year);
        }
        else {
            $timestamp = mktime(23, 59, 59, $month, $day, $year);
        }
        return $timestamp;
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
