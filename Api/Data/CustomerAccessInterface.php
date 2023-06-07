<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Api\Data;

interface CustomerAccessInterface
{

    const CUSTOMER_ID = 'customer_id';
    const URL = 'url';
    const CUSTOMERACCESS_ID = 'customeraccess_id';
    const ROUTE = 'route';
    const ACCESS_TIME = 'access_time';
    const CUSTOMER_EMAIL = 'customer_email';
    const ADDITIONAL_DATA = 'additional_data';
    const CUSTOMER_NAME = 'customer_name';
    const CITY = 'city';
    const DEVICE = 'device';

    /**
     * Get customeraccess_id
     * @return string|null
     */
    public function getCustomeraccessId();

    /**
     * Set customeraccess_id
     * @param string $customeraccessId
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setCustomeraccessId($customeraccessId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get customer_name
     * @return string|null
     */
    public function getCustomerName();

    /**
     * Set customer_name
     * @param string $customerName
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setCustomerName($customerName);

    /**
     * Get customer_email
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * Set customer_email
     * @param string $customerEmail
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setCustomerEmail($customerEmail);

    /**
     * Get access_time
     * @return string|null
     */
    public function getAccessTime();

    /**
     * Set access_time
     * @param string $accessTime
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setAccessTime($accessTime);

    /**
     * Get device
     * @return string|null
     */
    public function getDevice();

    /**
     * Set device
     * @param string $device
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setDevice($device);

    /**
     * Get city
     * @return string|null
     */
    public function getCity();

    /**
     * Set city
     * @param string $city
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setCity($city);

    /**
     * Get url
     * @return string|null
     */
    public function getUrl();

    /**
     * Set url
     * @param string $url
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setUrl($url);

    /**
     * Get route
     * @return string|null
     */
    public function getRoute();

    /**
     * Set route
     * @param string $route
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setRoute($route);

    /**
     * Get additional_data
     * @return string|null
     */
    public function getAdditionalData();

    /**
     * Set additional_data
     * @param string $additionalData
     * @return \Infobase\CustomerAccess\CustomerAccess\Api\Data\CustomerAccessInterface
     */
    public function setAdditionalData($additionalData);
}

