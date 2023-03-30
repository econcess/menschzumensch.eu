<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class FaqTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Faq
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mwwebinare\Mwwebinare\Domain\Model\Faq();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getFrageReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFrage()
        );
    }

    /**
     * @test
     */
    public function setFrageForStringSetsFrage()
    {
        $this->subject->setFrage('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'frage',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAntwortReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAntwort()
        );
    }

    /**
     * @test
     */
    public function setAntwortForStringSetsAntwort()
    {
        $this->subject->setAntwort('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'antwort',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBiildReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getBiild()
        );
    }

    /**
     * @test
     */
    public function setBiildForFileReferenceSetsBiild()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setBiild($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'biild',
            $this->subject
        );
    }
}
