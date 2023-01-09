<?php
declare(strict_types=1);

namespace Sandip\Extension\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Sandip\Extension\Api\Data\TrackerInterface;


class TrackerResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'tracker_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct():void
    {
        $this->_init(TrackerInterface::TABLE_NAME, TrackerInterface::TRACKER_ID);
        $this->_useIsObjectNew = true;
    }
}
