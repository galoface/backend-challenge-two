<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Model;

use Infobase\CustomerAccess\Api\CustomerAccessRepositoryInterface;
use Infobase\CustomerAccess\Api\Data\CustomerAccessInterface;
use Infobase\CustomerAccess\Api\Data\CustomerAccessInterfaceFactory;
use Infobase\CustomerAccess\Api\Data\CustomerAccessSearchResultsInterfaceFactory;
use Infobase\CustomerAccess\Model\ResourceModel\CustomerAccess as ResourceCustomerAccess;
use Infobase\CustomerAccess\Model\ResourceModel\CustomerAccess\CollectionFactory as CustomerAccessCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerAccessRepository implements CustomerAccessRepositoryInterface
{

    /**
     * @var ResourceCustomerAccess
     */
    protected $resource;

    /**
     * @var CustomerAccessCollectionFactory
     */
    protected $customerAccessCollectionFactory;

    /**
     * @var CustomerAccessInterfaceFactory
     */
    protected $customerAccessFactory;

    /**
     * @var CustomerAccess
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceCustomerAccess $resource
     * @param CustomerAccessInterfaceFactory $customerAccessFactory
     * @param CustomerAccessCollectionFactory $customerAccessCollectionFactory
     * @param CustomerAccessSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCustomerAccess $resource,
        CustomerAccessInterfaceFactory $customerAccessFactory,
        CustomerAccessCollectionFactory $customerAccessCollectionFactory,
        CustomerAccessSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->customerAccessFactory = $customerAccessFactory;
        $this->customerAccessCollectionFactory = $customerAccessCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CustomerAccessInterface $customerAccess)
    {
        try {
            $this->resource->save($customerAccess);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customerAccess: %1',
                $exception->getMessage()
            ));
        }
        return $customerAccess;
    }

    /**
     * @inheritDoc
     */
    public function get($customerAccessId)
    {
        $customerAccess = $this->customerAccessFactory->create();
        $this->resource->load($customerAccess, $customerAccessId);
        if (!$customerAccess->getId()) {
            throw new NoSuchEntityException(__('CustomerAccess with id "%1" does not exist.', $customerAccessId));
        }
        return $customerAccess;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerAccessCollectionFactory->create();
        
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
    public function delete(CustomerAccessInterface $customerAccess)
    {
        try {
            $customerAccessModel = $this->customerAccessFactory->create();
            $this->resource->load($customerAccessModel, $customerAccess->getCustomeraccessId());
            $this->resource->delete($customerAccessModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CustomerAccess: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($customerAccessId)
    {
        return $this->delete($this->get($customerAccessId));
    }
}

