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

class Results extends Template
{
    /**
     * @var SansecReportsRepositoryInterface
     */
    private $reportsRepository;

    /**
     * Results constructor.
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
    public function getResultArray()
    {
        if ($entityId = $this->getRequest()->getParam('sansecreports_id')) {
            $returnArray = [];
            // Retrieve report
            $report = $this->reportsRepository->get($entityId);

            // Prepare array for template
            foreach (json_decode($report->getResults(), true) as $result) {
                foreach ($result as $resultItemHeader => $resultItemValue) {
                    // Use name as key
                    if ($resultItemHeader == 'name') {
                        continue;
                    // Exception for 'detections', this is an (important) array
                    } elseif ($resultItemHeader == 'detections') {
                        // If it isnt an array, return All Clear
                        if (is_array($resultItemValue)) {
                            foreach ($resultItemValue as $detection) {
                                foreach ($detection as $detectionInfoHeader => $detectionInfoValue) {
                                    // Use name as key
                                    if ($detectionInfoHeader == 'name') {
                                        continue;
                                    } elseif (is_array($detectionInfoValue)) {
                                        // Some items might be an array, so return it as a string so it can be printed
                                        $detectionInfoValue = json_encode($detectionInfoValue, JSON_PRETTY_PRINT);
                                    }
                                    $returnArray[$result['name']]['detections'][$detectionInfoHeader] = $detectionInfoValue;
                                }
                            }
                            continue;
                        } else {
                            $resultItemValue = "All Clear, no detections!";
                        }
                    // If not detections but still array, return as a string so it can be printed
                    } elseif (is_array($resultItemValue)) {
                        $resultItemValue = json_encode($resultItemValue, JSON_PRETTY_PRINT);
                    // If value is false, return it as a string so it can be printed
                    } elseif (!$resultItemValue) {
                        $resultItemValue = 'No data';
                    }

                    $returnArray[$result['name']][$resultItemHeader] = $resultItemValue;
                }

            }

            return $returnArray;

        }

        return [];
    }

    /**
     * @param $resultInfo
     * @return bool
     */
    public function getHasDetection($resultInfo)
    {
        foreach ($resultInfo as $item => $value) {
            if ($item == 'detections' && is_array($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int|string|null
     * @throws LocalizedException
     */
    public function getDetectionAmount()
    {
        if ($entityId = $this->getRequest()->getParam('sansecreports_id')) {
            // Retrieve report data
            $report = $this->reportsRepository->get($entityId);
            return (int)$report->getDetectionsAmount();
        }

        return 0;
    }

}
