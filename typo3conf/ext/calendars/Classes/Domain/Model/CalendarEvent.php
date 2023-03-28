<?php

namespace CodingMs\Calendars\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use CodingMs\AddressManager\Domain\Repository\AddressRepository;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 *
 *
 * @package calendars
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CalendarEvent extends AbstractEntity
{

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $subtitle;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Calendars\Domain\Model\CalendarEventCategory>
     */
    protected $calendarEventCategory;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Calendars\Domain\Model\CalendarEventRegistration>
     */
    protected $registrations;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @var int
     */
    protected $address = null;

    /**
     * @var integer
     */
    protected $registrationPid;

    /**
     * @var string
     */
    protected $registrationAddress;

    /**
     * @var string
     */
    protected $teaser = '';

    /**
     * @var string
     */
    protected $description = '';


    /**
     * @var bool
     */
    protected $hideLinksToDetailView = false;

    /**
     * Event images
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $images;

    /**
     * @var string
     */
    protected $externalLink;

    /**
     * @var int
     */
    protected $ticketAmount;

    /**
     * @var int
     */
    protected $ticketsAvailable;

    /**
     * @var \DateTime
     * @since 2.0.0
     */
    protected $starttime;

    /**
     * @var \DateTime
     * @since 2.0.0
     */
    protected $endtime;

    /**
     * @var string
     */
    protected $info = '';

    /**
     * @var string
     */
    protected $attribute1 = '';

    /**
     * @var string
     */
    protected $attribute2 = '';

    /**
     * @var string
     */
    protected $attribute3 = '';

    /**
     * @var string
     */
    protected $attribute4 = '';

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $frontendUser = null;

    /**
     * @var bool
     */
    protected $deleted = true;

    /**
     * @var boolean
     */
    protected $hidden;

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function injectObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the extension builder
         * You may modify the constructor of this class instead
         */
        $this->calendarEventCategory = new ObjectStorage();
        $this->registration = new ObjectStorage();
        $this->images = new ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the subtitle
     *
     * @return string $subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Sets the subtitle
     *
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitleForSelect()
    {
        $settings = $GLOBALS['EXTENSIONS']['calendars']['settings'];
        $date = date($settings['formatting']['date']['format'], $this->startDate->getTimestamp());
        return $date . ' - ' . $this->title;
    }

    /**
     * Adds a Event-Category
     *
     * @param \CodingMs\Calendars\Domain\Model\CalendarEventCategory $calendarEventCategory
     * @return void
     */
    public function addCalendarEventCategory(CalendarEventCategory $calendarEventCategory)
    {
        $this->calendarEventCategory->attach($calendarEventCategory);
    }

    /**
     * Removes a Event-Category
     *
     * @param \CodingMs\Calendars\Domain\Model\CalendarEventCategory $calendarEventCategoryToRemove The Event-Category to be removed
     * @return void
     */
    public function removeCalendarEventCategory(CalendarEventCategory $calendarEventCategoryToRemove)
    {
        $this->calendarEventCategory->detach($calendarEventCategoryToRemove);
    }

    /**
     * Returns the calendarEventCategory
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Calendars\Domain\Model\CalendarEventCategory> $calendarEventCategory
     */
    public function getCalendarEventCategory()
    {
        return $this->calendarEventCategory;
    }

    /**
     * Sets the calendarEventCategory
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Calendars\Domain\Model\CalendarEventCategory> $calendarEventCategory
     * @return void
     */
    public function setCalendarEventCategory(ObjectStorage $calendarEventCategory)
    {
        $this->calendarEventCategory = $calendarEventCategory;
    }

    /**
     * @param \CodingMs\Calendars\Domain\Model\CalendarEventRegistration $registration
     * @return void
     */
    public function addRegistration(CalendarEventRegistration $registration)
    {
        $this->registrations->attach($registration);
    }

    /**
     * @param \CodingMs\Calendars\Domain\Model\CalendarEventRegistration $registrationToRemove The Event-Registration to be removed
     * @return void
     */
    public function removeRegistration(CalendarEventRegistration $registrationToRemove)
    {
        $this->registrations->detach($registrationToRemove);
    }

    /**
     * Returns the registration
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Calendars\Domain\Model\CalendarEventRegistration> $registrations
     */
    public function getRegistrations()
    {
        return $this->registrations;
    }

    /**
     * @return array
     */
    public function getRegistrationsArray(): array
    {
        $data = [];
        /** @var CalendarEventRegistration $registration */
        foreach ($this->getRegistrations() as $registration) {
            $data[] = $registration->getArray();
        }
        return $data;
    }

    /**
     * Sets the registration
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\Calendars\Domain\Model\CalendarEventRegistration> $registrations
     * @return void
     */
    public function setRegistrations(ObjectStorage $registrations)
    {
        $this->registrations = $registrations;
    }

    /**
     * Returns the calendar event category variants
     *
     * @return array
     */
    public function getCalendarEventCategoryVariants()
    {
        $variants = [];
        /** @var CalendarEventCategory $category */
        foreach ($this->getCalendarEventCategory() as $category) {
            $variants[] = $category->getVariant();
        }
        $variants = array_unique($variants);
        return $variants;
    }

    /**
     * Returns the startDate
     *
     * @return \DateTime|null $startDate
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    /**
     * Sets the startDate
     *
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * Returns the endDate
     *
     * @return \DateTime|null $endDate
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    /**
     * Sets the endDate
     *
     * @param \DateTime $endDate
     * @return void
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Returns the address
     *
     * @return \CodingMs\AddressManager\Domain\Model\Address|null $address
     */
    public function getAddress()
    {
        $address = null;
        if ((int)$this->address > 0) {
            $addressRepository = $this->objectManager->get(AddressRepository::class);
            $address = $addressRepository->findByIdentifier((int)$this->address);
        }
        return $address;
    }

    /**
     * Sets the address
     *
     * @param \CodingMs\AddressManager\Domain\Model\Address $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getRegistrationPid()
    {
        return $this->registrationPid;
    }

    /**
     * @param int $registrationPid
     */
    public function setRegistrationPid($registrationPid)
    {
        $this->registrationPid = $registrationPid;
    }

    /**
     * @return string
     */
    public function getRegistrationAddress(): string
    {
        return $this->registrationAddress;
    }

    /**
     * @param string $registrationAddress
     */
    public function setRegistrationAddress(string $registrationAddress)
    {
        $this->registrationAddress = $registrationAddress;
    }

    /**
     * @return string
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * @param string $teaser
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function getHideLinksToDetailView(): bool
    {
        return $this->hideLinksToDetailView;
    }

    /**
     * @param bool $hideLinksToDetailView
     */
    public function setHideLinksToDetailView(bool $hideLinksToDetailView): void
    {
        $this->hideLinksToDetailView = $hideLinksToDetailView;
    }

    /**
     * Adds a image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(FileReference $image)
    {
        $this->images->attach($image);
    }

    /**
     * Removes a image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The image to be removed
     * @return void
     */
    public function removeImage(FileReference $imageToRemove)
    {
        $this->images->detach($imageToRemove);
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     * @return void
     */
    public function setImages(ObjectStorage $images)
    {
        $this->images = $images;
    }

    /**
     * Returns the externalLink
     *
     * @return string $externalLink
     */
    public function getExternalLink()
    {
        return $this->externalLink;
    }

    /**
     * Sets the externalLink
     *
     * @param string $externalLink
     * @return void
     */
    public function setExternalLink($externalLink)
    {
        $this->externalLink = $externalLink;
    }

    /**
     * Returns the starttime
     *
     * @return \DateTime $starttime
     * @since 2.0.0
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * Sets the starttime
     *
     * @param \DateTime $starttime
     * @return void
     * @since 2.0.0
     */
    public function setStarttime($starttime)
    {
        $this->starttime = $starttime;
    }

    /**
     * Returns the endtime
     *
     * @return \DateTime $endtime
     * @since 2.0.0
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * Sets the endtime
     *
     * @param \DateTime $endtime
     * @return void
     * @since 2.0.0
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;
    }

    /**
     * @return int
     */
    public function getTicketAmount()
    {
        return $this->ticketAmount;
    }

    /**
     * @param int $ticketAmount
     */
    public function setTicketAmount($ticketAmount)
    {
        $this->ticketAmount = $ticketAmount;
    }

    /**
     * @return int
     */
    public function getTicketsAvailable()
    {
        return $this->ticketsAvailable;
    }

    /**
     * @param int $ticketsAvailable
     */
    public function setTicketsAvailable($ticketsAvailable)
    {
        $this->ticketsAvailable = $ticketsAvailable;
    }

    /**
     * @return string
     */
    public function getInfo(): string
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo(string $info): void
    {
        $this->info = $info;
    }

    /**
     * Returns the attribute1
     *
     * @return string $attribute1
     */
    public function getAttribute1()
    {
        return $this->attribute1;
    }

    /**
     * Sets the attribute1
     *
     * @param string $attribute1
     * @return void
     */
    public function setAttribute1($attribute1)
    {
        $this->attribute1 = $attribute1;
    }

    /**
     * Returns the attribute2
     *
     * @return string $attribute2
     */
    public function getAttribute2()
    {
        return $this->attribute2;
    }

    /**
     * Sets the attribute2
     *
     * @param string $attribute2
     * @return void
     */
    public function setAttribute2($attribute2)
    {
        $this->attribute2 = $attribute2;
    }

    /**
     * Returns the attribute3
     *
     * @return string $attribute3
     */
    public function getAttribute3()
    {
        return $this->attribute3;
    }

    /**
     * Sets the attribute3
     *
     * @param string $attribute3
     * @return void
     */
    public function setAttribute3($attribute3)
    {
        $this->attribute3 = $attribute3;
    }

    /**
     * Returns the attribute4
     *
     * @return string $attribute4
     */
    public function getAttribute4()
    {
        return $this->attribute4;
    }

    /**
     * Sets the attribute4
     *
     * @param string $attribute4
     * @return void
     */
    public function setAttribute4($attribute4)
    {
        $this->attribute4 = $attribute4;
    }

    /**
     * Returns the frontend user
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    public function getFrontendUser(): ?FrontendUser
    {
        return $this->frontendUser;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser
     */
    public function setFrontendUser(FrontendUser $frontendUser) : void
    {
        $this->frontendUser = $frontendUser;
    }

    /**
     * @return bool
     */
    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

}
