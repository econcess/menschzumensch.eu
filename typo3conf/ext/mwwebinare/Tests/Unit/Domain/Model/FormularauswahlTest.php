<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class FormularauswahlTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getFormularReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFormular()
        );
    }

    /**
     * @test
     */
    public function setFormularForStringSetsFormular()
    {
        $this->subject->setFormular('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'formular',
            $this->subject
        );
    }
}
