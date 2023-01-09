<?php
declare(strict_types=1);

namespace Sandip\Extension\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Sandip\Extension\Api\Data\TrackerInterface;
use Sandip\Extension\Model\ResourceModel\TrackerResource;

class TrackerModel extends AbstractModel implements TrackerInterface, IdentityInterface
{
    const CACHE_TAG = 'tracker_model';

    /**
     * @var string
     */
    protected $_cacheTag = 'tracker_model';

    /**
     * @var string
     */
    protected $_eventPrefix = 'tracker_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TrackerResource::class);
    }

    /**
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Getter for TrackerId.
     *
     * @return int|null
     */
    public function getTrackerId(): ?int
    {
        return $this->getData(self::TRACKER_ID) === null ? null
            : (int)$this->getData(self::TRACKER_ID);
    }

    /**
     * Setter for TrackerId.
     *
     * @param int|null $trackerId
     *
     * @return void
     */
    public function setTrackerId(?int $trackerId): TrackerInterface
    {
        return $this->setData(self::TRACKER_ID, $trackerId);
    }

    /**
     * Getter for TrackingCode.
     *
     * @return int|null
     */
    public function getTrackingCode(): ?int
    {
        return $this->getData(self::TRACKING_CODE) === null ? null
            : (int)$this->getData(self::TRACKING_CODE);
    }

    /**
     * Setter for TrackingCode.
     *
     * @param int|null $trackingCode
     *
     * @return void
     */
    public function setTrackingCode(?int $trackingCode): TrackerInterface
    {
        return $this->setData(self::TRACKING_CODE, $trackingCode);
    }

    /**
     * Getter for TrackingMessage.
     *
     * @return string|null
     */
    public function getTrackingMessage(): ?string
    {
        return $this->getData(self::TRACKING_MESSAGE);
    }

    /**
     * Setter for TrackingMessage.
     *
     * @param string|null $trackingMessage
     *
     * @return void
     */
    public function setTrackingMessage(?string $trackingMessage): TrackerInterface
    {
        return $this->setData(self::TRACKING_MESSAGE, $trackingMessage);
    }

    /**
     * Getter for CreateAt.
     *
     * @return string|null
     */
    public function getCreateAt(): ?string
    {
        return $this->getData(self::CREATE_AT);
    }

    /**
     * Setter for CreateAt.
     *
     * @param string|null $createAt
     *
     * @return void
     */
    public function setCreateAt(?string $createAt): TrackerInterface
    {
        return $this->setData(self::CREATE_AT, $createAt);
    }

    /**
     * Getter for Sku.
     *
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->getData(self::SKU);
    }

    /**
     * Setter for Sku.
     *
     * @param string|null $sku
     *
     * @return void
     */
    public function setSku(?string $sku): TrackerInterface
    {
        return $this->setData(self::SKU, $sku);
    }
}
