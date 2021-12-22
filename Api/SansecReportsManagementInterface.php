<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Api;

interface SansecReportsManagementInterface
{

    /**
     * POST for SansecReports api
     * @param mixed $checkResults
     * @param mixed $ctx
     * @return string
     */
    public function postSansecReports($checkResults, $ctx);
}

