<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Api\Data;

interface CustomerAccessSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get CustomerAccess list.
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface[]
     */
    public function getItems();

    /**
     * Set customer_id list.
     * @param \Infobase\CustomerAccess\Api\Data\CustomerAccessInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

