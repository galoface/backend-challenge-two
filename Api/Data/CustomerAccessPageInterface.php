<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Api\Data;

interface CustomerAccessPageInterface
{

    const PAGE = 'page';
    const CUSTOMERACCESSPAGE_ID = 'customeraccesspage_id';

    /**
     * Get customeraccesspage_id
     * @return string|null
     */
    public function getCustomeraccesspageId();

    /**
     * Set customeraccesspage_id
     * @param string $customeraccesspageId
     * @return \Infobase\CustomerAccess\CustomerAccessPage\Api\Data\CustomerAccessPageInterface
     */
    public function setCustomeraccesspageId($customeraccesspageId);

    /**
     * Get page
     * @return string|null
     */
    public function getPage();

    /**
     * Set page
     * @param string $page
     * @return \Infobase\CustomerAccess\CustomerAccessPage\Api\Data\CustomerAccessPageInterface
     */
    public function setPage($page);
}

