<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Plugin\Magento\Framework\App;

use Infobase\CustomerAccess\Helper\Data;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory as PageCollectionFactory;
use Infobase\CustomerAccess\Model\OptionsProvider\PageOptionsProvider;
use Infobase\CustomerAccess\Model\CustomerAccessFactory;
use Infobase\CustomerAccess\Api\CustomerAccessRepositoryInterface;
use Infobase\CustomerAccess\Api\Data\AccessLogInterfaceFactory;

/**
 * Class Action
 * @package Infobase\CustomerAccess\Plugin\Magento\Framework\App
 */
class Action
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var AccessLogInterfaceFactory
     */
    private $accessLog;

    /**
     * @var AccessLogRepositoryInterface
     */
    private $accessLogRepository;

    /**
     * @var Json
     */
    private $serializer;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var HelperData
     */
    private $helperData;

    /**
     * @var PageCollectionFactory
     */
    protected $pageCollectionFactory;

    /**
     * @var PageOptionsProvider
     */
    protected $pageOptionsProvider;

    /**
     * @var CustomerAccessFactory
     */
    protected $customerAccessFactory;

    /**
     * @var CustomerAccessRepositoryInterface
     */
    protected $customerAccessRepository;


    /**
     * @param Session $session
     * @param StoreManagerInterface $storeManager
     * @param Json $serializer
     * @param UrlInterface $url
     * @param ProductRepositoryInterface $productRepository
     * @param HelperData $helperData
     */
    public function __construct(
        Session $session,
        StoreManagerInterface $storeManager,
        Json $serializer,
        UrlInterface $url,
        ProductRepositoryInterface $productRepository,
        PageCollectionFactory $pageCollectionFactory,
        PageOptionsProvider $pageOptionsProvider,
        CustomerAccessRepositoryInterface $customerAccessRepository,
        Data $helperData,
        CustomerAccessFactory $customerAccessFactory
    )
    {
        $this->session = $session;
        $this->storeManager = $storeManager;
        $this->serializer = $serializer;
        $this->url = $url;
        $this->productRepository = $productRepository;
        $this->pageCollectionFactory = $pageCollectionFactory;
        $this->pageOptionsProvider = $pageOptionsProvider;
        $this->helperData = $helperData;
        $this->customerAccessFactory = $customerAccessFactory;
        $this->customerAccessRepository = $customerAccessRepository;
    }

    /**
     * @param \Magento\Framework\App\Action\Action $subject
     * @param RequestInterface $request
     * @return RequestInterface[]
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeDispatch(\Magento\Framework\App\Action\Action $subject, RequestInterface $request)
    {

        if (!$this->session->isLoggedIn()) {
            return [$request];
        }

        if (array_key_exists($request->getFullActionName(), $this->pageOptionsProvider->getAllRouteActions())) {
            $this->writeLog($request, $request->getFullActionName(), $request->getOriginalPathInfo());
        }

        return [$request];
    }

    /**
     * @param RequestInterface $request
     * @param string $action
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function writeLog(RequestInterface $request, string $action, string $cmsPath = null): bool
    {
        try {
            $accessLog = $this->customerAccessFactory->create();
            $customer = $this->helperData->getCustomerData();
            $accessLog->setCustomerId($customer["customer_id"]);
            $accessLog->setCustomerName($customer["customer_name"]);
            $accessLog->setCustomerEmail($customer["customer_email"]);
            $accessLog->setAccessTime($this->helperData->getAccessTime());
            $accessLog->setDevice($this->helperData->getDevice());

            switch ($action) {
                case 'catalog_product_view':
                    $product = $this->productRepository->getById($request->getParam('id'));
                    $productData = $this->helperData->getProductData($product);
                    $accessLog->setUrl($this->url->getCurrentUrl());
                    $accessLog->setAdditionalData($productData);
                    $this->customerAccessRepository->save($accessLog);
                    break;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

