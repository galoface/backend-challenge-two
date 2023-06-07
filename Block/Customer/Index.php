<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Block\Customer;

use Infobase\CustomerAccess\Api\CustomerAccessRepositoryInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session;
use Infobase\CustomerAccess\Model\ResourceModel\CustomerAccess\CollectionFactory;

/**
 * Class Index
 * @package Infobase\CustomerAccess\Block\Customer
 */
class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        CustomerAccessRepositoryInterface $customerAccessRepository,
        Session $customerSession,
        CollectionFactory $collectionFactory,
        array $data = []
    )
    {
        $this->customerAccessRepository = $customerAccessRepository;
        $this->customerSession = $customerSession;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return null
     * @throws \Exception
     */
    public function getCustomerAccessPages()
    {
        try {
            if ($this->customerSession->isLoggedIn()) {
                $customer = $this->customerSession->getCustomer();

                $customerAccess = $this->collectionFactory->create()
                    ->addFieldToFilter("customer_email", $customer->getEmail())
                    ->getItems();

                if($customerAccess) {
                    return $customerAccess;
                }

                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}

