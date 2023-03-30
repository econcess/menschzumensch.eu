<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class FormularauswahlControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Controller\FormularauswahlController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Controller\FormularauswahlController::class)
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
    public function listActionFetchesAllFormularauswahlsFromRepositoryAndAssignsThemToView()
    {

        $allFormularauswahls = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $formularauswahlRepository = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Domain\Repository\FormularauswahlRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $formularauswahlRepository->expects(self::once())->method('findAll')->will(self::returnValue($allFormularauswahls));
        $this->inject($this->subject, 'formularauswahlRepository', $formularauswahlRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('formularauswahls', $allFormularauswahls);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenFormularauswahlToView()
    {
        $formularauswahl = new \Mwwebinare\Mwwebinare\Domain\Model\Formularauswahl();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('formularauswahl', $formularauswahl);

        $this->subject->showAction($formularauswahl);
    }
}
