<?php
declare(strict_types=1);

namespace Sandip\Extension\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Sandip\Extension\Api\TrackerManagerInterface;

class Track implements ObserverInterface
{
    /**
     * @var TrackerManagerInterface
     */
    private $trackerManager;

    /**
     * @param TrackerManagerInterface $trackerManager
     */
    public function __construct(TrackerManagerInterface $trackerManager)
    {
        $this->trackerManager = $trackerManager;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        $this->trackerManager->track((string)$item->getSku(), (float)$item->getProduct()->getPrice());
    }
}
