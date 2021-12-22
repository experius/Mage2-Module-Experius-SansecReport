<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Api\Data;

interface SansecReportsInterface
{

    const RESULTS = 'results';
    const DATE_REPORT = 'date_report';
    const DETECTIONS_AMOUNT = 'detections_amount';
    const CTX = 'ctx';
    const SANSECREPORTS_ID = 'sansecreports_id';
    const IS_VERIFIED = 'is_verified';

    /**
     * Get sansecreports_id
     * @return string|null
     */
    public function getSansecreportsId();

    /**
     * Set sansecreports_id
     * @param string $sansecreportsId
     * @return \Experius\SansecReport\SansecReports\Api\Data\SansecReportsInterface
     */
    public function setSansecreportsId($sansecreportsId);

    /**
     * Get date_report
     * @return string|null
     */
    public function getDateReport();

    /**
     * Set date_report
     * @param string $dateReport
     * @return \Experius\SansecReport\SansecReports\Api\Data\SansecReportsInterface
     */
    public function setDateReport($dateReport);

    /**
     * Get detections_amount
     * @return string|null
     */
    public function getDetectionsAmount();

    /**
     * Set detections_amount
     * @param string $detectionsAmount
     * @return \Experius\SansecReport\SansecReports\Api\Data\SansecReportsInterface
     */
    public function setDetectionsAmount($detectionsAmount);

    /**
     * Get ctx
     * @return string|null
     */
    public function getCtx();

    /**
     * Set ctx
     * @param string $ctx
     * @return \Experius\SansecReport\SansecReports\Api\Data\SansecReportsInterface
     */
    public function setCtx($ctx);

    /**
     * Get results
     * @return string|null
     */
    public function getResults();

    /**
     * Set results
     * @param string $results
     * @return \Experius\SansecReport\SansecReports\Api\Data\SansecReportsInterface
     */
    public function setResults($results);

    /**
     * Get results
     * @return int|null
     */
    public function getIsVerified();

    /**
     * Set results
     * @param int $isVerified
     * @return \Experius\SansecReport\SansecReports\Api\Data\SansecReportsInterface
     */
    public function setIsVerified($isVerified);
}

