<?php
namespace Mwwebinare\Mwwebinare\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Martin Weymayer <office@weymayer.at>
 */
class FaqControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Mwwebinare\Mwwebinare\Controller\FaqController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Controller\FaqController::class)
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
    public function listActionFetchesAllFaqsFromRepositoryAndAssignsThemToView()
    {

        $allFaqs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $faqRepository = $this->getMockBuilder(\Mwwebinare\Mwwebinare\Domain\Repository\FaqRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $faqRepository->expects(self::once())->method('findAll')->will(self::returnValue($allFaqs));
        $this->inject($this->subject, 'faqRepository', $faqRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('faqs', $allFaqs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenFaqToView()
    {
        $faq = new \Mwwebinare\Mwwebinare\Domain\Model\Faq();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('faq', $faq);

        $this->subject->showAction($faq);
    }
}
