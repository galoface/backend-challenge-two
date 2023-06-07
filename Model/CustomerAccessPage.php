<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Model;

use Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface;
use Magento\Framework\Model\AbstractModel;

class CustomerAccessPage extends AbstractModel implements CustomerAccessPageInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Infobase\CustomerAccess\Model\ResourceModel\CustomerAccessPage::class);
    }

    /**
     * @inheritDoc
     */
    public function getCustomeraccesspageId()
    {
        return $this->getData(self::CUSTOMERACCESSPAGE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomeraccesspageId($customeraccesspageId)
    {
        return $this->setData(self::CUSTOMERACCESSPAGE_ID, $customeraccesspageId);
    }

    /**
     * @inheritDoc
     */
    public function getPage()
    {
        return $this->getData(self::PAGE);
    }

    /**
     * @inheritDoc
     */
    public function setPage($page)
    {
        return $this->setData(self::PAGE, $page);
    }
}

