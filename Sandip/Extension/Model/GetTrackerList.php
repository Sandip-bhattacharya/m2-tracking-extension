<?php
declare(strict_types=1);

namespace Sandip\Extension\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Sandip\Extension\Api\GetTrackerListInterface;
use Sandip\Extension\Api\TrackerRepositoryInterface;
use Sandip\Extension\Model\ResourceModel\TrackerModel\TrackerCollectionFactory;

class GetTrackerList implements GetTrackerListInterface
{
    /**
     * @var
     */
    private $trackerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param TrackerRepositoryInterface $trackerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        TrackerRepositoryInterface $trackerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->trackerRepository = $trackerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $allTrackers = $this->trackerRepository->getList($searchCriteria);
        /** @var  $items \Sandip\Extension\Api\Data\TrackerInterface[] */
        $items = $allTrackers->getItems();
        return $items;
    }
}
