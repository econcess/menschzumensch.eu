<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class TermineControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Controller\TermineController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Controller\TermineController::class)
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
    public function listActionFetchesAllTerminesFromRepositoryAndAssignsThemToView()
    {

        $allTermines = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $termineRepository = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Domain\Repository\TermineRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $termineRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTermines));
        $this->inject($this->subject, 'termineRepository', $termineRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('termines', $allTermines);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTermineToView()
    {
        $termine = new \Mwwebinare\Mwwebinare\Domain\Model\Termine();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('termine', $termine);

        $this->subject->showAction($termine);
    }
}
