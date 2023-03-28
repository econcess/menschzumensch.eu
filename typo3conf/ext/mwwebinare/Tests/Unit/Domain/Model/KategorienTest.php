<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class KategorienTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Kategorien
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mwwebinare\Mwwebinare\Domain\Model\Kategorien();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getKategorieReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getKategorie()
        );
    }

    /**
     * @test
     */
    public function setKategorieForStringSetsKategorie()
    {
        $this->subject->setKategorie('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'kategorie',
            $this->subject
        );
    }
}
