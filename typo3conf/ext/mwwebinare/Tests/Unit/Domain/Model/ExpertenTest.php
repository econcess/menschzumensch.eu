<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class ExpertenTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Experten
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mwwebinare\Mwwebinare\Domain\Model\Experten();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNachnameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNachname()
        );
    }

    /**
     * @test
     */
    public function setNachnameForStringSetsNachname()
    {
        $this->subject->setNachname('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nachname',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getVornameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getVorname()
        );
    }

    /**
     * @test
     */
    public function setVornameForStringSetsVorname()
    {
        $this->subject->setVorname('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'vorname',
            $this->subject
        );
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
    public function getSpezialgebietReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSpezialgebiet()
        );
    }

    /**
     * @test
     */
    public function setSpezialgebietForStringSetsSpezialgebiet()
    {
        $this->subject->setSpezialgebiet('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'spezialgebiet',
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
    public function getBildReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getBild()
        );
    }

    /**
     * @test
     */
    public function setBildForFileReferenceSetsBild()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setBild($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'bild',
            $this->subject
        );
    }
}
