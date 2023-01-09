<?php
declare(strict_types=1);

namespace Sandip\Extension\Api;

use Magento\Framework\Api\Search\SearchResult;
use Magento\Framework\Api\SearchCriteriaInterface;
use Sandip\Extension\Api\Data\TrackerInterface;

interface TrackerRepositoryInterface
{
    /**
     * @param int $trackerId
     * @return TrackerInterface
     */
    public function get(int $trackerId): TrackerInterface;

    /**
     * @param TrackerInterface $tracker
     * @return TrackerInterface
     */
    public function save(TrackerInterface $tracker): TrackerInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResult
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResult;

    /**
     * @param TrackerInterface $tracker
     * @return bool
     */
    public function delete(TrackerInterface $tracker): bool;

    /**
     * @param int $trackerId
     * @return bool
     */
    public function deleteById(int $trackerId): bool;
}
