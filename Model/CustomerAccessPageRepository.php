<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Model;

use Infobase\CustomerAccess\Api\CustomerAccessPageRepositoryInterface;
use Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterface;
use Infobase\CustomerAccess\Api\Data\CustomerAccessPageInterfaceFactory;
use Infobase\CustomerAccess\Api\Data\CustomerAccessPageSearchResultsInterfaceFactory;
use Infobase\CustomerAccess\Model\ResourceModel\CustomerAccessPage as ResourceCustomerAccessPage;
use Infobase\CustomerAccess\Model\ResourceModel\CustomerAccessPage\CollectionFactory as CustomerAccessPageCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerAccessPageRepository implements CustomerAccessPageRepositoryInterface
{

    /**
     * @var ResourceCustomerAccessPage
     */
    protected $resource;

    /**
     * @var CustomerAccessPageInterfaceFactory
     */
    protected $customerAccessPageFactory;

    /**
     * @var CustomerAccessPageCollectionFactory
     */
    protected $customerAccessPageCollectionFactory;

    /**
     * @var CustomerAccessPage
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceCustomerAccessPage $resource
     * @param CustomerAccessPageInterfaceFactory $customerAccessPageFactory
     * @param CustomerAccessPageCollectionFactory $customerAccessPageCollectionFactory
     * @param CustomerAccessPageSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCustomerAccessPage $resource,
        CustomerAccessPageInterfaceFactory $customerAccessPageFactory,
        CustomerAccessPageCollectionFactory $customerAccessPageCollectionFactory,
        CustomerAccessPageSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->customerAccessPageFactory = $customerAccessPageFactory;
        $this->customerAccessPageCollectionFactory = $customerAccessPageCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(
        CustomerAccessPageInterface $customerAccessPage
    ) {
        try {
            $this->resource->save($customerAccessPage);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customerAccessPage: %1',
                $exception->getMessage()
            ));
        }
        return $customerAccessPage;
    }

    /**
     * @inheritDoc
     */
    public function get($customerAccessPageId)
    {
        $customerAccessPage = $this->customerAccessPageFactory->create();
        $this->resource->load($customerAccessPage, $customerAccessPageId);
        if (!$customerAccessPage->getId()) {
            throw new NoSuchEntityException(__('CustomerAccessPage with id "%1" does not exist.', $customerAccessPageId));
        }
        return $customerAccessPage;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerAccessPageCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(
        CustomerAccessPageInterface $customerAccessPage
    ) {
        try {
            $customerAccessPageModel = $this->customerAccessPageFactory->create();
            $this->resource->load($customerAccessPageModel, $customerAccessPage->getCustomeraccesspageId());
            $this->resource->delete($customerAccessPageModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CustomerAccessPage: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($customerAccessPageId)
    {
        return $this->delete($this->get($customerAccessPageId));
    }
}

