<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Block\Adminhtml\SansecReports\View;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Experius\SansecReport\Api\SansecReportsRepositoryInterface;

class VerifyButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var SansecReportsRepositoryInterface
     */
    private $reportsRepository;

    /**
     * VerifyButton constructor.
     * @param SansecReportsRepositoryInterface $reportsRepository
     * @param Context $context
     */
    public function __construct(
        SansecReportsRepositoryInterface $reportsRepository,
        Context $context
    ) {
        $this->reportsRepository = $reportsRepository;
        parent::__construct($context);
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    public function getButtonData()
    {
        $report = $this->reportsRepository->get($this->getModelId());
        if ($report && !$report->getIsVerified()) {
            return [
                'label' => __('Verify'),
                'on_click' => sprintf("location.href = '%s';", $this->getVerifyUrl()),
                'class' => 'primary',
                'sort_order' => 10
            ];
        }

        return [];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getVerifyUrl()
    {
        return $this->getUrl('*/*/verify', ['sansecreports_id' => $this->getModelId()]);
    }
}

