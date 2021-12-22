<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SansecReportsRepositoryInterface
{

    /**
     * Save SansecReports
     * @param \Experius\SansecReport\Api\Data\SansecReportsInterface $sansecReports
     * @return \Experius\SansecReport\Api\Data\SansecReportsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Experius\SansecReport\Api\Data\SansecReportsInterface $sansecReports
    );

    /**
     * Retrieve SansecReports
     * @param string $sansecreportsId
     * @return \Experius\SansecReport\Api\Data\SansecReportsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($sansecreportsId);

    /**
     * Retrieve SansecReports matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Experius\SansecReport\Api\Data\SansecReportsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SansecReports
     * @param \Experius\SansecReport\Api\Data\SansecReportsInterface $sansecReports
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Experius\SansecReport\Api\Data\SansecReportsInterface $sansecReports
    );

    /**
     * Delete SansecReports by ID
     * @param string $sansecreportsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sansecreportsId);
}

