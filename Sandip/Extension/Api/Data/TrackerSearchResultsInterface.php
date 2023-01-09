<?php
declare(strict_types=1);

namespace Sandip\Extension\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Tracker entity search result.
 */
interface TrackerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Sandip\Extension\Api\Data\TrackerInterface[] $items
     *
     * @return TrackerSearchResultsInterface
     */
    public function setItems(array $items): TrackerSearchResultsInterface;

    /**
     * Get items.
     *
     * @return \Sandip\Extension\Api\Data\TrackerInterface[]
     */
    public function getItems(): array;
}
