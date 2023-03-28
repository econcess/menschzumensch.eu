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
 * Formularauswahl
 */
class Formularauswahl extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * formular
     *
     * @var string
     */
    protected $formular = '';

    /**
     * Returns the formular
     *
     * @return string $formular
     */
    public function getFormular()
    {
        return $this->formular;
    }

    /**
     * Sets the formular
     *
     * @param string $formular
     * @return void
     */
    public function setFormular($formular)
    {
        $this->formular = $formular;
    }
}
