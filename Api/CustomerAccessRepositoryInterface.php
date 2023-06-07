<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerAccessRepositoryInterface
{

    /**
     * Save CustomerAccess
     * @param \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface $customerAccess
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface $customerAccess
    );

    /**
     * Retrieve CustomerAccess
     * @param string $customeraccessId
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customeraccessId);

    /**
     * Retrieve CustomerAccess matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CustomerAccess
     * @param \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface $customerAccess
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface $customerAccess
    );

    /**
     * Delete CustomerAccess by ID
     * @param string $customeraccessId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customeraccessId);
}

