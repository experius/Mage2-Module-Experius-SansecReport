<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Model\ResourceModel\SansecReports;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'sansecreports_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Experius\SansecReport\Model\SansecReports::class,
            \Experius\SansecReport\Model\ResourceModel\SansecReports::class
        );
    }
}

