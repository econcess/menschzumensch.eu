<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class ExpertenControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Controller\ExpertenController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Controller\ExpertenController::class)
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
    public function listActionFetchesAllExpertensFromRepositoryAndAssignsThemToView()
    {

        $allExpertens = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $expertenRepository = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Domain\Repository\ExpertenRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $expertenRepository->expects(self::once())->method('findAll')->will(self::returnValue($allExpertens));
        $this->inject($this->subject, 'expertenRepository', $expertenRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('expertens', $allExpertens);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenExpertenToView()
    {
        $experten = new \Mwwebinare\Mwwebinare\Domain\Model\Experten();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('experten', $experten);

        $this->subject->showAction($experten);
    }
}
