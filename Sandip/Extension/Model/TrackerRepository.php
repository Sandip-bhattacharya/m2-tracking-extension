<?php
declare(strict_types=1);

namespace Sandip\Extension\Model;

use Magento\Framework\Api\Search\SearchResult;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Sandip\Extension\Api\Data\TrackerInterface;
use Sandip\Extension\Api\Data\TrackerSearchResultsInterfaceFactory;
use Sandip\Extension\Api\TrackerRepositoryInterface;
use Sandip\Extension\Model\ResourceModel\TrackerModel\TrackerCollectionFactory;
use Sandip\Extension\Model\ResourceModel\TrackerResource;

class TrackerRepository implements TrackerRepositoryInterface
{
    /**
     * @var TrackerResource
     */
    private $resource;

    /**
     * @var TrackerModelFactory
     */
    private $trackerModelFactory;

    /**
     * @var TrackerCollectionFactory
     */
    private $collectionFactory;

    /**
     * @var TrackerSearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param TrackerResource $resource
     * @param TrackerModelFactory $trackerModelFactory
     * @param TrackerCollectionFactory $collectionFactory
     * @param TrackerSearchResultsInterfaceFactory $trackerSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        TrackerResource $resource,
        TrackerModelFactory $trackerModelFactory,
        TrackerCollectionFactory $collectionFactory,
        TrackerSearchResultsInterfaceFactory $trackerSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->trackerModelFactory = $trackerModelFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultFactory = $trackerSearchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param int $trackerId
     * @return TrackerInterface
     * @throws NoSuchEntityException
     */
    public function get(int $trackerId): TrackerInterface
    {
        $tracker = $this->trackerModelFactory->create();
        $tracker->load($trackerId);

        if (!$tracker->getId()) {
            throw new NoSuchEntityException(
                __('The Tracker with the "%1" ID doesn\'t exist.', $trackerId)
            );
        }
        return $tracker;
    }

    /**
     * @param TrackerInterface $tracker
     * @return TrackerInterface
     * @throws CouldNotSaveException
     */
    public function save(TrackerInterface $tracker): TrackerInterface
    {
        try {
            $this->resource->save($tracker);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __("Could not Save the tracker %1",
                    $exception->getMessage())
            );
        }
        return $tracker;
    }


    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResult
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResult
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        /** @var  $items \Sandip\Extension\Api\Data\TrackerInterface[] */
        $items = $collection->getItems();
        $searchResult->setItems($items);
        return $searchResult;
    }

    /**
     * @param TrackerInterface $tracker
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(TrackerInterface $tracker): bool
    {
        try {
            $this->resource->delete($tracker);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                "Could not delete tracker %1",
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param int $trackerId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $trackerId): bool
    {
        return $this->delete($this->get($trackerId));
    }
}
