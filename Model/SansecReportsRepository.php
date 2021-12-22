<?php
/**
 * Copyright © Experius All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\SansecReport\Model;

use Experius\SansecReport\Api\Data\SansecReportsInterface;
use Experius\SansecReport\Api\Data\SansecReportsInterfaceFactory;
use Experius\SansecReport\Api\Data\SansecReportsSearchResultsInterfaceFactory;
use Experius\SansecReport\Api\SansecReportsRepositoryInterface;
use Experius\SansecReport\Model\ResourceModel\SansecReports as ResourceSansecReports;
use Experius\SansecReport\Model\ResourceModel\SansecReports\CollectionFactory as SansecReportsCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class SansecReportsRepository implements SansecReportsRepositoryInterface
{

    /**
     * @var SansecReportsInterfaceFactory
     */
    protected $sansecReportsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SansecReports
     */
    protected $searchResultsFactory;

    /**
     * @var SansecReportsCollectionFactory
     */
    protected $sansecReportsCollectionFactory;

    /**
     * @var ResourceSansecReports
     */
    protected $resource;

    /**
     * SansecReportsRepository constructor.
     * @param ResourceSansecReports $resource
     * @param SansecReportsInterfaceFactory $sansecReportsFactory
     * @param SansecReportsCollectionFactory $sansecReportsCollectionFactory
     * @param SansecReportsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSansecReports $resource,
        SansecReportsInterfaceFactory $sansecReportsFactory,
        SansecReportsCollectionFactory $sansecReportsCollectionFactory,
        SansecReportsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->sansecReportsFactory = $sansecReportsFactory;
        $this->sansecReportsCollectionFactory = $sansecReportsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SansecReportsInterface $sansecReports)
    {
        try {
            $this->resource->save($sansecReports);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sansecReports: %1',
                $exception->getMessage()
            ));
        }
        return $sansecReports;
    }

    /**
     * @inheritDoc
     */
    public function get($sansecReportsId)
    {
        $sansecReports = $this->sansecReportsFactory->create();
        $this->resource->load($sansecReports, $sansecReportsId);
        if (!$sansecReports->getId()) {
            throw new NoSuchEntityException(__('SansecReports with id "%1" does not exist.', $sansecReportsId));
        }
        return $sansecReports;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sansecReportsCollectionFactory->create();

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
    public function delete(SansecReportsInterface $sansecReports)
    {
        try {
            $sansecReportsModel = $this->sansecReportsFactory->create();
            $this->resource->load($sansecReportsModel, $sansecReports->getSansecreportsId());
            $this->resource->delete($sansecReportsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SansecReports: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($sansecReportsId)
    {
        return $this->delete($this->get($sansecReportsId));
    }
}

