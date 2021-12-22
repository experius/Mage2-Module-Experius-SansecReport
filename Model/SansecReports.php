<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Model;

use Experius\SansecReport\Api\Data\SansecReportsInterface;
use Magento\Framework\Model\AbstractModel;

class SansecReports extends AbstractModel implements SansecReportsInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Experius\SansecReport\Model\ResourceModel\SansecReports::class);
    }

    /**
     * @inheritDoc
     */
    public function getSansecreportsId()
    {
        return $this->getData(self::SANSECREPORTS_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSansecreportsId($sansecreportsId)
    {
        return $this->setData(self::SANSECREPORTS_ID, $sansecreportsId);
    }

    /**
     * @inheritDoc
     */
    public function getDateReport()
    {
        return $this->getData(self::DATE_REPORT);
    }

    /**
     * @inheritDoc
     */
    public function setDateReport($dateReport)
    {
        return $this->setData(self::DATE_REPORT, $dateReport);
    }

    /**
     * @inheritDoc
     */
    public function getDetectionsAmount()
    {
        return $this->getData(self::DETECTIONS_AMOUNT);
    }

    /**
     * @inheritDoc
     */
    public function setDetectionsAmount($detectionsAmount)
    {
        return $this->setData(self::DETECTIONS_AMOUNT, $detectionsAmount);
    }

    /**
     * @inheritDoc
     */
    public function getCtx()
    {
        return $this->getData(self::CTX);
    }

    /**
     * @inheritDoc
     */
    public function setCtx($ctx)
    {
        return $this->setData(self::CTX, $ctx);
    }

    /**
     * @inheritDoc
     */
    public function getResults()
    {
        return $this->getData(self::RESULTS);
    }

    /**
     * @inheritDoc
     */
    public function setResults($results)
    {
        return $this->setData(self::RESULTS, $results);
    }

    /**
     * @inheritDoc
     */
    public function getIsVerified()
    {
        return $this->getData(self::IS_VERIFIED);
    }

    /**
     * @inheritDoc
     */
    public function setIsVerified($isVerified)
    {
        return $this->setData(self::IS_VERIFIED, $isVerified);
    }
}

