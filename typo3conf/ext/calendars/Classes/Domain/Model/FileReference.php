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

/**
 * File Reference
 */
class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference
{

    /**
     * Obsolete when foreign_selector is supported by ExtBase persistence layer
     *
     * @var int
     */
    protected $uidLocal;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $alternative;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var bool
     */
    protected $preview;

    /**
     * Set File uid
     *
     * @param int $fileUid
     */
    public function setFileUid($fileUid)
    {
        $this->uidLocal = $fileUid;
    }

    /**
     * Get File UID
     *
     * @return int
     */
    public function getFileUid()
    {
        return $this->uidLocal;
    }

    /**
     * Set alternative
     *
     * @param string $alternative
     */
    public function setAlternative($alternative)
    {
        $this->alternative = $alternative;
    }

    /**
     * Get alternative
     *
     * @return string
     */
    public function getAlternative()
    {
        return $this->alternative !== null ? $this->alternative : $this->getOriginalResource()->getAlternative();
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description !== null ? $this->description : $this->getOriginalResource()->getDescription();
    }

    /**
     * Set link
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Get link
     *
     * @return mixed
     */
    public function getLink()
    {
        return $this->link !== null ? $this->link : $this->getOriginalResource()->getLink();
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title !== null ? $this->title : $this->getOriginalResource()->getTitle();
    }

    /**
     * Set preview
     *
     * @param bool $preview
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    /**
     * Get preview
     *
     * @return bool
     */
    public function getPreview()
    {
        return $this->preview;
    }
}
