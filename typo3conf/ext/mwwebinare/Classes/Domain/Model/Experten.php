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
 * Experten
 */
class Experten extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * nachname
     *
     * @var string
     */
    protected $nachname = '';

    /**
     * vorname
     *
     * @var string
     */
    protected $vorname = '';

    /**
     * titel
     *
     * @var string
     */
    protected $titel = '';

    /**
     * spezialgebiet
     *
     * @var string
     */
    protected $spezialgebiet = '';

    /**
     * beschreibung
     *
     * @var string
     */
    protected $beschreibung = '';
//+1126/econcess
    /**
     * bild
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
//-1126/econcess
    protected $bild = '';

    /**
     * Returns the nachname
     *
     * @return string $nachname
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * Sets the nachname
     *
     * @param string $nachname
     * @return void
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * Returns the vorname
     *
     * @return string $vorname
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Sets the vorname
     *
     * @param string $vorname
     * @return void
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * Returns the titel
     *
     * @return string $titel
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * Sets the titel
     *
     * @param string $titel
     * @return void
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    /**
     * Returns the spezialgebiet
     *
     * @return string $spezialgebiet
     */
    public function getSpezialgebiet()
    {
        return $this->spezialgebiet;
    }

    /**
     * Sets the spezialgebiet
     *
     * @param string $spezialgebiet
     * @return void
     */
    public function setSpezialgebiet($spezialgebiet)
    {
        $this->spezialgebiet = $spezialgebiet;
    }

    /**
     * Returns the beschreibung
     *
     * @return string $beschreibung
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

    /**
     * Sets the beschreibung
     *
     * @param string $beschreibung
     * @return void
     */
    public function setBeschreibung($beschreibung)
    {
        $this->beschreibung = $beschreibung;
    }

    /**
     * Returns the bild
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference bild
     */
    public function getBild()
    {
        return $this->bild;
    }

    /**
     * Sets the bild
     *
     * @param string $bild
     * @return void
     */
    public function setBild($bild)
    {
        $this->bild = $bild;
    }
}
