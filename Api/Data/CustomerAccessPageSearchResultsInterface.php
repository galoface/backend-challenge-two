<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Api\Data;

interface CustomerAccessPageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get CustomerAccessPage list.
     * @return \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface[]
     */
    public function getItems();

    /**
     * Set page list.
     * @param \Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

