<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Api\Data;

interface SansecReportsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get SansecReports list.
     * @return \Experius\SansecReport\Api\Data\SansecReportsInterface[]
     */
    public function getItems();

    /**
     * Set date_report list.
     * @param \Experius\SansecReport\Api\Data\SansecReportsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

