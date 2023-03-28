<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class TermineTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Termine
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mwwebinare\Mwwebinare\Domain\Model\Termine();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getBeginnReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getBeginn()
        );
    }

    /**
     * @test
     */
    public function setBeginnForDateTimeSetsBeginn()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setBeginn($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'beginn',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEndeReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getEnde()
        );
    }

    /**
     * @test
     */
    public function setEndeForDateTimeSetsEnde()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setEnde($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'ende',
            $this->subject
        );
    }
}
