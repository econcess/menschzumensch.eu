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
 * Webinare
 */
class Webinare extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * titel
     *
     * @var string
     */
    protected $titel = '';

    /**
     * versionsschulung
     *
     * @var string
     */
    protected $versionsschulung = '';

    /**
     * beschreibung
     *
     * @var string
     */
    protected $beschreibung = '';
	
	/**
     * wichtigsteninfos
     *
     * @var string
     */
    protected $wichtigsteninfos = '';

    /**
     * link
     *
     * @var string
     */
    protected $link = '';
	
	/**
     * linktext
     *
     * @var string
     */
    protected $linktext = '';

    /**
     * standort
     *
     * @var string
     */
    protected $standort = '';

    /**
     * dauer
     *
     * @var string
     */
    protected $dauer = '';

    /**
     * grueneslabel
     *
     * @var int
     */
    protected $grueneslabel = 0;

    /**
     * status
     *
     * @var int
     */
    protected $status = 0;

    /**
     * buttonbuchendeaktiv
     *
     * @var int
     */
    protected $buttonbuchendeaktiv = 0;

    /**
     * verfuegbarkeit
     *
     * @var string
     */
    protected $verfuegbarkeit = '';

    /**
     * ticket
     *
     * @var int
     */
    protected $ticket = 0;

    /**
     * ticketverfuegbar
     *
     * @var int
     */
    protected $ticketverfuegbar = 0;
//+1124/econcess
    /**
     * bilder
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $bilder = null;

    /**
     * video
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $video = null;

    /**
     * youtubecode
     *
     * @var string
     */
    protected $youtubecode = '';

    /**
     * termine
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Termine>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
//-1124/econcess
    protected $termine = null;

    /**
     * kategorien
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Kategorien>
     */
    protected $kategorien = null;

    /**
     * experten
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Experten>
     */
    protected $experten = null;

    /**
     * formularauswahl
     *
     * @var \GeorgRinger\News\Domain\Model\News
     */
    protected $formularauswahl = null;

    /**
     * formularauswahlint
     *
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl
     */
    protected $formularauswahlint = null;

    /**
     * registrationaddress
     *
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Registrationaddress
     */
    protected $registrationaddress = null;

    /**
     * registrationpage
     *
     * @var \GeorgRinger\News\Domain\Model\News
     */
    protected $registrationpage = null;

    /**
     * registrationaddressext
     *
     * @var \GeorgRinger\News\Domain\Model\News
     */
    protected $registrationaddressext = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->bilder = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->termine = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->kategorien = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->experten = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the versionsschulung
     *
     * @return string $versionsschulung
     */
    public function getVersionsschulung()
    {
        return $this->versionsschulung;
    }

    /**
     * Sets the versionsschulung
     *
     * @param string $versionsschulung
     * @return void
     */
    public function setVersionsschulung($versionsschulung)
    {
        $this->versionsschulung = $versionsschulung;
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
	
	###
	/**
     * Returns the wichtigsteninfos
     *
     * @return string $wichtigsteninfos
     */
    public function getWichtigsteninfos()
    {
        return $this->wichtigsteninfos;
    }

    /**
     * Sets the wichtigsteninfos
     *
     * @param string $wichtigsteninfos
     * @return void
     */
    public function setWichtigsteninfos($wichtigsteninfos)
    {
        $this->wichtigsteninfos = $wichtigsteninfos;
    }

    /**
     * Returns the link
     *
     * @return string $link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the link
     *
     * @param string $link
     * @return void
     */
    public function setLink($link)
    {
        $this->link = $link;
    }
	
	############
	/**
     * Returns the linktext
     *
     * @return string $linktext
     */
    public function getLinktext()
    {
        return $this->linktext;
    }

    /**
     * Sets the linktext
     *
     * @param string $linktext
     * @return void
     */
    public function setLinktext($linktext)
    {
        $this->linktext = $linktext;
    }


    /**
     * Returns the standort
     *
     * @return string $standort
     */
    public function getStandort()
    {
        return $this->standort;
    }

    /**
     * Sets the standort
     *
     * @param string $standort
     * @return void
     */
    public function setStandort($standort)
    {
        $this->standort = $standort;
    }

    /**
     * Returns the dauer
     *
     * @return string $dauer
     */
    public function getDauer()
    {
        return $this->dauer;
    }

    /**
     * Sets the dauer
     *
     * @param string $dauer
     * @return void
     */
    public function setDauer($dauer)
    {
        $this->dauer = $dauer;
    }

    /**
     * Returns the grueneslabel
     *
     * @return int $grueneslabel
     */
    public function getGrueneslabel()
    {
        return $this->grueneslabel;
    }

    /**
     * Sets the grueneslabel
     *
     * @param int $grueneslabel
     * @return void
     */
    public function setGrueneslabel($grueneslabel)
    {
        $this->grueneslabel = $grueneslabel;
    }

    /**
     * Returns the status
     *
     * @return int $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param int $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Returns the buttonbuchendeaktiv
     *
     * @return int $buttonbuchendeaktiv
     */
    public function getButtonbuchendeaktiv()
    {
        return $this->buttonbuchendeaktiv;
    }

    /**
     * Sets the buttonbuchendeaktiv
     *
     * @param int $buttonbuchendeaktiv
     * @return void
     */
    public function setButtonbuchendeaktiv($buttonbuchendeaktiv)
    {
        $this->buttonbuchendeaktiv = $buttonbuchendeaktiv;
    }

    /**
     * Returns the verfuegbarkeit
     *
     * @return string $verfuegbarkeit
     */
    public function getVerfuegbarkeit()
    {
        return $this->verfuegbarkeit;
    }

    /**
     * Sets the verfuegbarkeit
     *
     * @param string $verfuegbarkeit
     * @return void
     */
    public function setVerfuegbarkeit($verfuegbarkeit)
    {
        $this->verfuegbarkeit = $verfuegbarkeit;
    }

    /**
     * Returns the ticket
     *
     * @return int $ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Sets the ticket
     *
     * @param int $ticket
     * @return void
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Returns the ticketverfuegbar
     *
     * @return int $ticketverfuegbar
     */
    public function getTicketverfuegbar()
    {
        return $this->ticketverfuegbar;
    }

    /**
     * Sets the ticketverfuegbar
     *
     * @param int $ticketverfuegbar
     * @return void
     */
    public function setTicketverfuegbar($ticketverfuegbar)
    {
        $this->ticketverfuegbar = $ticketverfuegbar;
    }

    /**
     * Adds a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $bilder
     * @return void
     */
    public function addBilder(\TYPO3\CMS\Extbase\Domain\Model\FileReference $bilder)
    {
        $this->bilder->attach($bilder);
    }

    /**
     * Removes a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $bilderToRemove The FileReference to be removed
     * @return void
     */
    public function removeBilder(\TYPO3\CMS\Extbase\Domain\Model\FileReference $bilderToRemove)
    {
        $this->bilder->detach($bilderToRemove);
    }

    /**
     * Returns the bilder
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $bilder
     */
    public function getBilder()
    {
        return $this->bilder;
    }

    /**
     * Sets the bilder
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $bilder
     * @return void
     */
    public function setBilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $bilder)
    {
        $this->bilder = $bilder;
    }

    /**
     * Returns the video
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Sets the video
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $video
     * @return void
     */
    public function setVideo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $video)
    {
        $this->video = $video;
    }

    /**
     * Returns the youtubecode
     *
     * @return string $youtubecode
     */
    public function getYoutubecode()
    {
        return $this->youtubecode;
    }

    /**
     * Sets the youtubecode
     *
     * @param string $youtubecode
     * @return void
     */
    public function setYoutubecode($youtubecode)
    {
        $this->youtubecode = $youtubecode;
    }

    /**
     * Adds a Termine
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Termine $termine
     * @return void
     */
    public function addTermine(\Mwwebinare\Mwwebinare\Domain\Model\Termine $termine)
    {
        $this->termine->attach($termine);
    }

    /**
     * Removes a Termine
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Termine $termineToRemove The Termine to be removed
     * @return void
     */
    public function removeTermine(\Mwwebinare\Mwwebinare\Domain\Model\Termine $termineToRemove)
    {
        $this->termine->detach($termineToRemove);
    }

    /**
     * Returns the termine
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Termine> $termine
     */
    public function getTermine()
    {
        return $this->termine;
    }

    /**
     * Sets the termine
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Termine> $termine
     * @return void
     */
    public function setTermine(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $termine)
    {
        $this->termine = $termine;
    }

    /**
     * Adds a Kategorien
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Kategorien $kategorien
     * @return void
     */
    public function addKategorien(\Mwwebinare\Mwwebinare\Domain\Model\Kategorien $kategorien)
    {
        $this->kategorien->attach($kategorien);
    }

    /**
     * Removes a Kategorien
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Kategorien $kategorienToRemove The Kategorien to be removed
     * @return void
     */
    public function removeKategorien(\Mwwebinare\Mwwebinare\Domain\Model\Kategorien $kategorienToRemove)
    {
        $this->kategorien->detach($kategorienToRemove);
    }

    /**
     * Returns the kategorien
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Kategorien> $kategorien
     */
    public function getKategorien()
    {
        return $this->kategorien;
    }

    /**
     * Sets the kategorien
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Kategorien> $kategorien
     * @return void
     */
    public function setKategorien(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kategorien)
    {
        $this->kategorien = $kategorien;
    }

    /**
     * Returns the formularauswahl
     *
     * @return \GeorgRinger\News\Domain\Model\News $formularauswahl
     */
    public function getFormularauswahl()
    {
        return $this->formularauswahl;
    }

    /**
     * Sets the formularauswahl
     *
     * @param \GeorgRinger\News\Domain\Model\News $formularauswahl
     * @return void
     */
    public function setFormularauswahl(\GeorgRinger\News\Domain\Model\News $formularauswahl)
    {
        $this->formularauswahl = $formularauswahl;
    }

    /**
     * Returns the registrationaddress
     *
     * @return \Mwwebinare\Mwwebinare\Domain\Model\Registrationaddress $registrationaddress
     */
    public function getRegistrationaddress()
    {
        return $this->registrationaddress;
    }

    /**
     * Sets the registrationaddress
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Registrationaddress $registrationaddress
     * @return void
     */
    public function setRegistrationaddress(\Mwwebinare\Mwwebinare\Domain\Model\Registrationaddress $registrationaddress)
    {
        $this->registrationaddress = $registrationaddress;
    }

    /**
     * Returns the registrationpage
     *
     * @return \GeorgRinger\News\Domain\Model\News $registrationpage
     */
    public function getRegistrationpage()
    {
        return $this->registrationpage;
    }

    /**
     * Sets the registrationpage
     *
     * @param \GeorgRinger\News\Domain\Model\News $registrationpage
     * @return void
     */
    public function setRegistrationpage(\GeorgRinger\News\Domain\Model\News $registrationpage)
    {
        $this->registrationpage = $registrationpage;
    }

    /**
     * Returns the formularauswahlint
     *
     * @return \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl $formularauswahlint
     */
    public function getFormularauswahlint()
    {
        return $this->formularauswahlint;
    }

    /**
     * Sets the formularauswahlint
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl $formularauswahlint
     * @return void
     */
    public function setFormularauswahlint(\Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl $formularauswahlint)
    {
        $this->formularauswahlint = $formularauswahlint;
    }

    /**
     * Returns the registrationaddressext
     *
     * @return \GeorgRinger\News\Domain\Model\News $registrationaddressext
     */
    public function getRegistrationaddressext()
    {
        return $this->registrationaddressext;
    }

    /**
     * Sets the registrationaddressext
     *
     * @param \GeorgRinger\News\Domain\Model\News $registrationaddressext
     * @return void
     */
    public function setRegistrationaddressext(\GeorgRinger\News\Domain\Model\News $registrationaddressext)
    {
        $this->registrationaddressext = $registrationaddressext;
    }

    /**
     * Adds a Experten
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Experten $experten
     * @return void
     */
    public function addExperten(\Mwwebinare\Mwwebinare\Domain\Model\Experten $experten)
    {
        $this->experten->attach($experten);
    }

    /**
     * Removes a Experten
     *
     * @param \Mwwebinare\Mwwebinare\Domain\Model\Experten $expertenToRemove The Experten to be removed
     * @return void
     */
    public function removeExperten(\Mwwebinare\Mwwebinare\Domain\Model\Experten $expertenToRemove)
    {
        $this->experten->detach($expertenToRemove);
    }

    /**
     * Returns the experten
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Experten> $experten
     */
    public function getExperten()
    {
        return $this->experten;
    }

    /**
     * Sets the experten
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mwwebinare\Mwwebinare\Domain\Model\Experten> $experten
     * @return void
     */
    public function setExperten(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $experten)
    {
        $this->experten = $experten;
    }
}
