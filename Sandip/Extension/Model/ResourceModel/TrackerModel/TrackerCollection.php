<?php
declare(strict_types=1);
namespace Sandip\Extension\Model\ResourceModel\TrackerModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sandip\Extension\Model\ResourceModel\TrackerResource;
use Sandip\Extension\Model\TrackerModel;

class TrackerCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'tracker_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(TrackerModel::class, TrackerResource::class);
    }
}
