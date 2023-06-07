<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Helper;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;
use Magento\Framework\HTTP\Header;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Catalog\Model\Product;
use Magento\Framework\Locale\ResolverInterface;

/**
 * Class Data
 */
class Data
{

    /**
     * @var Session
     */
    private $session;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var Header
     */
    private $httpHeader;

    /**
     * @param Session $session
     * @param DateTime $dateTime
     * @param Header $httpHeader
     */
    public function __construct(
        Session $session,
        DateTime $dateTime,
        Header $httpHeader,
        ResolverInterface $locale
    )
    {
        $this->session = $session;
        $this->dateTime = $dateTime;
        $this->httpHeader = $httpHeader;
        $this->locale = $locale;
    }

    /**
     * @return Customer
     */
    private function getCustomer(): Customer
    {
        return $this->session->getCustomer();
    }

    /**
     * @return string
     */
    public function getDevice(): string
    {
        $userAgent = $this->httpHeader->getHttpUserAgent();
        $isMobile = \Zend_Http_UserAgent_Mobile::match($userAgent, $_SERVER);
        if ($isMobile) {
            return 'Mobile';
        }

        return 'Desktop';
    }

    /**
     * @return string
     */
    public function getAccessTime(): string
    {
        if (!$this->session->getAccessTime()) {
            $this->session->setAccessTime($this->dateTime->date());
        }
        $this->locale->setLocale('pt_BR');
        $newDateTime = $this->dateTime->date();
        $datetime1 = date_create($newDateTime);
        $datetime2 = date_create($this->session->getAccessTime());
        $interval = date_diff($datetime1, $datetime2);

        $this->session->setAccessTime($newDateTime);
        $hour = __('Hour')->getText();
        $minute = __('Minute')->getText();
        $seconds = __('Seconds')->getText();

        return $interval->format('%h ' . $hour . ' %i ' . $minute . ' %s ' . $seconds . '');
    }

    /**
     * @param $product
     * @return array
     */
    public function getProductData($product)
    {
        if ($product instanceof Product) {
            return [
                "product_sku" => $product->getSku(),
                "product_name" => $product->getName(),
                "product_price" => $product->getPrice()
            ];
        }

        return [];
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerData()
    {
        $customer = $this->getCustomer();

        if ($customer) {
            return [
                "customer_id" => $customer->getId(),
                "customer_name" => $customer->getName(),
                "customer_email" => $customer->getEmail()
            ];
        }

        return [];
    }
}
