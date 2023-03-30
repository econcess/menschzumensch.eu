<?php
namespace Mwwebinare\Mwwebinare\Domain\Model;

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
 * Termine
 */
class Termine extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * beginn
     *
     * @var \DateTime
     */
    protected $beginn = null;

    /**
     * ende
     *
     * @var \DateTime
     */
    protected $ende = null;

    /**
     * Returns the beginn
     *
     * @return \DateTime $beginn
     */
    public function getBeginn()
    {
        return $this->beginn;
    }

    /**
     * Sets the beginn
     *
     * @param \DateTime $beginn
     * @return void
     */
    public function setBeginn(\DateTime $beginn)
    {
        $this->beginn = $beginn;
    }

    /**
     * Returns the ende
     *
     * @return \DateTime $ende
     */
    public function getEnde()
    {
        return $this->ende;
    }

    /**
     * Sets the ende
     *
     * @param \DateTime $ende
     * @return void
     */
    public function setEnde(\DateTime $ende)
    {
        $this->ende = $ende;
    }
}
