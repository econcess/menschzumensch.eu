<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class WebinareTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Webinare
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mwwebinare\Mwwebinare\Domain\Model\Webinare();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitelReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitel()
        );
    }

    /**
     * @test
     */
    public function setTitelForStringSetsTitel()
    {
        $this->subject->setTitel('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'titel',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getVersionsschulungReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getVersionsschulung()
        );
    }

    /**
     * @test
     */
    public function setVersionsschulungForStringSetsVersionsschulung()
    {
        $this->subject->setVersionsschulung('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'versionsschulung',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBeschreibungReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBeschreibung()
        );
    }

    /**
     * @test
     */
    public function setBeschreibungForStringSetsBeschreibung()
    {
        $this->subject->setBeschreibung('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'beschreibung',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLinkReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLink()
        );
    }

    /**
     * @test
     */
    public function setLinkForStringSetsLink()
    {
        $this->subject->setLink('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'link',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStandortReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getStandort()
        );
    }

    /**
     * @test
     */
    public function setStandortForStringSetsStandort()
    {
        $this->subject->setStandort('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'standort',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDauerReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDauer()
        );
    }

    /**
     * @test
     */
    public function setDauerForStringSetsDauer()
    {
        $this->subject->setDauer('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'dauer',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGrueneslabelReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGrueneslabel()
        );
    }

    /**
     * @test
     */
    public function setGrueneslabelForIntSetsGrueneslabel()
    {
        $this->subject->setGrueneslabel(12);

        self::assertAttributeEquals(
            12,
            'grueneslabel',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getStatus()
        );
    }

    /**
     * @test
     */
    public function setStatusForIntSetsStatus()
    {
        $this->subject->setStatus(12);

        self::assertAttributeEquals(
            12,
            'status',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getButtonbuchendeaktivReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getButtonbuchendeaktiv()
        );
    }

    /**
     * @test
     */
    public function setButtonbuchendeaktivForIntSetsButtonbuchendeaktiv()
    {
        $this->subject->setButtonbuchendeaktiv(12);

        self::assertAttributeEquals(
            12,
            'buttonbuchendeaktiv',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getVerfuegbarkeitReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getVerfuegbarkeit()
        );
    }

    /**
     * @test
     */
    public function setVerfuegbarkeitForStringSetsVerfuegbarkeit()
    {
        $this->subject->setVerfuegbarkeit('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'verfuegbarkeit',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTicketReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getTicket()
        );
    }

    /**
     * @test
     */
    public function setTicketForIntSetsTicket()
    {
        $this->subject->setTicket(12);

        self::assertAttributeEquals(
            12,
            'ticket',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTicketverfuegbarReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getTicketverfuegbar()
        );
    }

    /**
     * @test
     */
    public function setTicketverfuegbarForIntSetsTicketverfuegbar()
    {
        $this->subject->setTicketverfuegbar(12);

        self::assertAttributeEquals(
            12,
            'ticketverfuegbar',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBilderReturnsInitialValueForFileReference()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getBilder()
        );
    }

    /**
     * @test
     */
    public function setBilderForFileReferenceSetsBilder()
    {
        $bilder = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneBilder = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneBilder->attach($bilder);
        $this->subject->setBilder($objectStorageHoldingExactlyOneBilder);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneBilder,
            'bilder',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addBilderToObjectStorageHoldingBilder()
    {
        $bilder = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $bilderObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $bilderObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($bilder));
        $this->inject($this->subject, 'bilder', $bilderObjectStorageMock);

        $this->subject->addBilder($bilder);
    }

    /**
     * @test
     */
    public function removeBilderFromObjectStorageHoldingBilder()
    {
        $bilder = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $bilderObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $bilderObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($bilder));
        $this->inject($this->subject, 'bilder', $bilderObjectStorageMock);

        $this->subject->removeBilder($bilder);
    }

    /**
     * @test
     */
    public function getVideoReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getVideo()
        );
    }

    /**
     * @test
     */
    public function setVideoForFileReferenceSetsVideo()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setVideo($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'video',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getYoutubecodeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getYoutubecode()
        );
    }

    /**
     * @test
     */
    public function setYoutubecodeForStringSetsYoutubecode()
    {
        $this->subject->setYoutubecode('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'youtubecode',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTermineReturnsInitialValueForTermine()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTermine()
        );
    }

    /**
     * @test
     */
    public function setTermineForObjectStorageContainingTermineSetsTermine()
    {
        $termine = new \Mwwebinare\Mwwebinare\Domain\Model\Termine();
        $objectStorageHoldingExactlyOneTermine = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTermine->attach($termine);
        $this->subject->setTermine($objectStorageHoldingExactlyOneTermine);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneTermine,
            'termine',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addTermineToObjectStorageHoldingTermine()
    {
        $termine = new \Mwwebinare\Mwwebinare\Domain\Model\Termine();
        $termineObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $termineObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($termine));
        $this->inject($this->subject, 'termine', $termineObjectStorageMock);

        $this->subject->addTermine($termine);
    }

    /**
     * @test
     */
    public function removeTermineFromObjectStorageHoldingTermine()
    {
        $termine = new \Mwwebinare\Mwwebinare\Domain\Model\Termine();
        $termineObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $termineObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($termine));
        $this->inject($this->subject, 'termine', $termineObjectStorageMock);

        $this->subject->removeTermine($termine);
    }

    /**
     * @test
     */
    public function getKategorienReturnsInitialValueForKategorien()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getKategorien()
        );
    }

    /**
     * @test
     */
    public function setKategorienForObjectStorageContainingKategorienSetsKategorien()
    {
        $kategorien = new \Mwwebinare\Mwwebinare\Domain\Model\Kategorien();
        $objectStorageHoldingExactlyOneKategorien = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneKategorien->attach($kategorien);
        $this->subject->setKategorien($objectStorageHoldingExactlyOneKategorien);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneKategorien,
            'kategorien',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addKategorienToObjectStorageHoldingKategorien()
    {
        $kategorien = new \Mwwebinare\Mwwebinare\Domain\Model\Kategorien();
        $kategorienObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $kategorienObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($kategorien));
        $this->inject($this->subject, 'kategorien', $kategorienObjectStorageMock);

        $this->subject->addKategorien($kategorien);
    }

    /**
     * @test
     */
    public function removeKategorienFromObjectStorageHoldingKategorien()
    {
        $kategorien = new \Mwwebinare\Mwwebinare\Domain\Model\Kategorien();
        $kategorienObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $kategorienObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($kategorien));
        $this->inject($this->subject, 'kategorien', $kategorienObjectStorageMock);

        $this->subject->removeKategorien($kategorien);
    }

    /**
     * @test
     */
    public function getExpertenReturnsInitialValueForExperten()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getExperten()
        );
    }

    /**
     * @test
     */
    public function setExpertenForObjectStorageContainingExpertenSetsExperten()
    {
        $experten = new \Mwwebinare\Mwwebinare\Domain\Model\Experten();
        $objectStorageHoldingExactlyOneExperten = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneExperten->attach($experten);
        $this->subject->setExperten($objectStorageHoldingExactlyOneExperten);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneExperten,
            'experten',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addExpertenToObjectStorageHoldingExperten()
    {
        $experten = new \Mwwebinare\Mwwebinare\Domain\Model\Experten();
        $expertenObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $expertenObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($experten));
        $this->inject($this->subject, 'experten', $expertenObjectStorageMock);

        $this->subject->addExperten($experten);
    }

    /**
     * @test
     */
    public function removeExpertenFromObjectStorageHoldingExperten()
    {
        $experten = new \Mwwebinare\Mwwebinare\Domain\Model\Experten();
        $expertenObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $expertenObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($experten));
        $this->inject($this->subject, 'experten', $expertenObjectStorageMock);

        $this->subject->removeExperten($experten);
    }

    /**
     * @test
     */
    public function getFormularauswahlReturnsInitialValueForNews()
    {
    }

    /**
     * @test
     */
    public function setFormularauswahlForNewsSetsFormularauswahl()
    {
    }

    /**
     * @test
     */
    public function getFormularauswahlintReturnsInitialValueForFormularauswahl()
    {
        self::assertEquals(
            null,
            $this->subject->getFormularauswahlint()
        );
    }

    /**
     * @test
     */
    public function setFormularauswahlintForFormularauswahlSetsFormularauswahlint()
    {
        $formularauswahlintFixture = new \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl();
        $this->subject->setFormularauswahlint($formularauswahlintFixture);

        self::assertAttributeEquals(
            $formularauswahlintFixture,
            'formularauswahlint',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRegistrationaddressReturnsInitialValueForRegistrationaddress()
    {
        self::assertEquals(
            null,
            $this->subject->getRegistrationaddress()
        );
    }

    /**
     * @test
     */
    public function setRegistrationaddressForRegistrationaddressSetsRegistrationaddress()
    {
        $registrationaddressFixture = new \Mwwebinare\Mwwebinare\Domain\Model\Registrationaddress();
        $this->subject->setRegistrationaddress($registrationaddressFixture);

        self::assertAttributeEquals(
            $registrationaddressFixture,
            'registrationaddress',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRegistrationpageReturnsInitialValueForNews()
    {
    }

    /**
     * @test
     */
    public function setRegistrationpageForNewsSetsRegistrationpage()
    {
    }

    /**
     * @test
     */
    public function getRegistrationaddressextReturnsInitialValueForNews()
    {
    }

    /**
     * @test
     */
    public function setRegistrationaddressextForNewsSetsRegistrationaddressext()
    {
    }
}
