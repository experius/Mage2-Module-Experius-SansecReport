<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Model;

use Experius\SansecReport\Api\Data\SansecReportsInterfaceFactory;
use Experius\SansecReport\Api\SansecReportsRepositoryInterface;

class SansecReportsManagement implements \Experius\SansecReport\Api\SansecReportsManagementInterface
{

    /**
     * @var SansecReportsRepositoryInterface
     */
    private $reportRepository;

    /**
     * @var SansecReportsInterfaceFactory
     */
    private $reportFactory;

    /**
     * SansecReportsManagement constructor.
     * @param SansecReportsInterfaceFactory $reportFactory
     * @param SansecReportsRepositoryInterface $reportRepository
     */
    public function __construct(
        SansecReportsInterfaceFactory $reportFactory,
        SansecReportsRepositoryInterface $reportRepository
    ) {
        $this->reportRepository = $reportRepository;
        $this->reportFactory = $reportFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function postSansecReports($checkResults, $ctx)
    {
        $newReport = $this->reportFactory->create();
        $detectionsAmount = 0;
        foreach ($checkResults as $result) {
            if (!isset($result['detections']) || !$result['detections']) {
                continue;
            }
            foreach ($result['detections'] as $detection) {
                if ($detection) {
                    $detectionsAmount++;
                }
            }
        }
        $newReport->setDetectionsAmount($detectionsAmount);
        $newReport->setCtx(json_encode($ctx));
        $newReport->setResults(json_encode($checkResults));
        $newReport->setIsVerified(0);
        $this->reportRepository->save($newReport);

        return 'New Report Saved.';
    }
}

