<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class WebinareControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Controller\WebinareController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Controller\WebinareController::class)
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
    public function listActionFetchesAllWebinaresFromRepositoryAndAssignsThemToView()
    {

        $allWebinares = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $webinareRepository = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Domain\Repository\WebinareRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $webinareRepository->expects(self::once())->method('findAll')->will(self::returnValue($allWebinares));
        $this->inject($this->subject, 'webinareRepository', $webinareRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('webinares', $allWebinares);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenWebinareToView()
    {
        $webinare = new \Mwwebinare\Mwwebinare\Domain\Model\Webinare();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('webinare', $webinare);

        $this->subject->showAction($webinare);
    }
}
