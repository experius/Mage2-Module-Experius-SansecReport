<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Block\Adminhtml\SansecReports\View;

use Experius\SansecReport\Api\SansecReportsRepositoryInterface;
use Magento\Backend\Block\Template;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Backend\Block\Template\Context;

class Header extends Template
{
    /**
     * @var SansecReportsRepositoryInterface
     */
    private $reportsRepository;

    /**
     * Header constructor.
     * @param SansecReportsRepositoryInterface $reportsRepository
     * @param Context $context
     * @param array $data
     * @param JsonHelper|null $jsonHelper
     * @param DirectoryHelper|null $directoryHelper
     */
    public function __construct(
        SansecReportsRepositoryInterface $reportsRepository,
        Context $context,
        array $data = [],
        ?JsonHelper $jsonHelper = null,
        ?DirectoryHelper $directoryHelper = null
    ) {
        $this->reportsRepository = $reportsRepository;
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    public function getHeaderArray()
    {
        if ($entityId = $this->getRequest()->getParam('sansecreports_id')) {
            // Retrieve report data
            $report = $this->reportsRepository->get($entityId);

            $headerArray = [];

            foreach (json_decode($report->getCtx()) as $infoHeader => $infoValue) {
                // Setup array for template
                // If array, print as JSON string so data can be printed
                if (is_array($infoValue)) {
                    $infoValue = json_encode($infoValue);
                // If data is false, return it as string so it can be printed
                } elseif (!$infoValue) {
                    $infoValue = 'false';
                // Remove potentially private (agency) information from header
                } elseif ($infoHeader == 'scan_cli' || $infoHeader == 'license_key') {
                    continue;
                }
                $headerArray[] = [
                    'name' => $infoHeader,
                    'value' => $infoValue
                ];
            }

            return $headerArray;

        }

        return [];
    }

}
