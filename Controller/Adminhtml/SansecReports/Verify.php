<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Controller\Adminhtml\SansecReports;

use Experius\SansecReport\Api\SansecReportsRepositoryInterface;
use Experius\SansecReport\Controller\Adminhtml\SansecReports;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Verify extends SansecReports
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var SansecReportsRepositoryInterface
     */
    private $reportsRepository;

    /**
     * Verify constructor.
     * @param SansecReportsRepositoryInterface $reportsRepository
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        SansecReportsRepositoryInterface $reportsRepository,
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->reportsRepository = $reportsRepository;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Verify action
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('sansecreports_id');

        if (!$id) {
            $this->messageManager->addErrorMessage(__('Error, wrong URL usage.'));
        }

        $report = $this->reportsRepository->get($id);

        if (!$report) {
            $this->messageManager->addErrorMessage(__('Error, report doesn exist (anymore).'));
        }

        $report->setIsVerified(1);
        if ($this->reportsRepository->save($report)) {
            $this->messageManager->addSuccessMessage(__('Report verified.'));
        } else {
            $this->messageManager->addSuccessMessage(__('Error during saving report.'));
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}

