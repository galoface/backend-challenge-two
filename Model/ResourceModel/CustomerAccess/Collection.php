<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Model\ResourceModel\CustomerAccess;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'customeraccess_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Infobase\CustomerAccess\Model\CustomerAccess::class,
            \Infobase\CustomerAccess\Model\ResourceModel\CustomerAccess::class
        );
    }
}

