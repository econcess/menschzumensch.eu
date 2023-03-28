<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class KategorienControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Controller\KategorienController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Controller\KategorienController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllKategoriensFromRepositoryAndAssignsThemToView()
    {

        $allKategoriens = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $kategorienRepository = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Domain\Repository\KategorienRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $kategorienRepository->expects(self::once())->method('findAll')->will(self::returnValue($allKategoriens));
        $this->inject($this->subject, 'kategorienRepository', $kategorienRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('kategoriens', $allKategoriens);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenKategorienToView()
    {
        $kategorien = new \Mwwebinare\Mwwebinare\Domain\Model\Kategorien();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('kategorien', $kategorien);

        $this->subject->showAction($kategorien);
    }
}
