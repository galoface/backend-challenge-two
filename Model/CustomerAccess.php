<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Model;

use Infobase\CustomerAccess\Api\Data\CustomerAccessInterface;
use Magento\Framework\Model\AbstractModel;

class CustomerAccess extends AbstractModel implements CustomerAccessInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Infobase\CustomerAccess\Model\ResourceModel\CustomerAccess::class);
    }

    /**
     * @inheritDoc
     */
    public function getCustomeraccessId()
    {
        return $this->getData(self::CUSTOMERACCESS_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomeraccessId($customeraccessId)
    {
        return $this->setData(self::CUSTOMERACCESS_ID, $customeraccessId);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerName()
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerName($customerName)
    {
        return $this->setData(self::CUSTOMER_NAME, $customerName);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerEmail()
    {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerEmail($customerEmail)
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * @inheritDoc
     */
    public function getAccessTime()
    {
        return $this->getData(self::ACCESS_TIME);
    }

    /**
     * @inheritDoc
     */
    public function setAccessTime($accessTime)
    {
        return $this->setData(self::ACCESS_TIME, $accessTime);
    }

    /**
     * @inheritDoc
     */
    public function getDevice()
    {
        return $this->getData(self::DEVICE);
    }

    /**
     * @inheritDoc
     */
    public function setDevice($device)
    {
        return $this->setData(self::DEVICE, $device);
    }

    /**
     * @inheritDoc
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * @inheritDoc
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * @inheritDoc
     */
    public function getUrl()
    {
        return $this->getData(self::URL);
    }

    /**
     * @inheritDoc
     */
    public function setUrl($url)
    {
        return $this->setData(self::URL, $url);
    }

    /**
     * @inheritDoc
     */
    public function getRoute()
    {
        return $this->getData(self::ROUTE);
    }

    /**
     * @inheritDoc
     */
    public function setRoute($route)
    {
        return $this->setData(self::ROUTE, $route);
    }

    /**
     * @inheritDoc
     */
    public function getAdditionalData()
    {
        return $this->getData(self::ADDITIONAL_DATA);
    }

    /**
     * @inheritDoc
     */
    public function setAdditionalData($additionalData)
    {
        if(is_array($additionalData)) {
            $jsonData = json_encode($additionalData);
            return $this->setData(self::ADDITIONAL_DATA, $jsonData);
        }
        return $this->setData(self::ADDITIONAL_DATA, "");
    }

}

