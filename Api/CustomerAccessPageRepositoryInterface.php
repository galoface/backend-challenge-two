<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerAccessPageRepositoryInterface
{

    /**
     * Save CustomerAccessPage
     * @param \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface $customerAccessPage
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface $customerAccessPage
    );

    /**
     * Retrieve CustomerAccessPage
     * @param string $customeraccesspageId
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customeraccesspageId);

    /**
     * Retrieve CustomerAccessPage matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessPageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CustomerAccessPage
     * @param \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface $customerAccessPage
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface $customerAccessPage
    );

    /**
     * Delete CustomerAccessPage by ID
     * @param string $customeraccesspageId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customeraccesspageId);
}

