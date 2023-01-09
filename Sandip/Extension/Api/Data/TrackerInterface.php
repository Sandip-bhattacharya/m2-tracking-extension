<?php
declare(strict_types=1);

namespace Sandip\Extension\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface TrackerInterface extends ExtensibleDataInterface
{
    /**
     * String constants for property names
     */
    const TRACKER_ID = "tracker_id";
    const TRACKING_CODE = "tracking_code";
    const TRACKING_MESSAGE = "tracking_message";
    const CREATE_AT = "create_at";

    const SKU = "sku";

    const TABLE_NAME = 'tracker';

    /**
     * Getter for TrackerId.
     *
     * @return int|null
     */
    public function getTrackerId(): ?int;

    /**
     * Setter for TrackerId.
     *
     * @param int|null $trackerId
     *
     * @return void
     */
    public function setTrackerId(?int $trackerId): TrackerInterface;

    /**
     * Getter for TrackingCode.
     *
     * @return int|null
     */
    public function getTrackingCode(): ?int;

    /**
     * Setter for TrackingCode.
     *
     * @param int|null $trackingCode
     *
     * @return void
     */
    public function setTrackingCode(?int $trackingCode): TrackerInterface;

    /**
     * Getter for TrackingMessage.
     *
     * @return string|null
     */
    public function getTrackingMessage(): ?string;

    /**
     * Setter for TrackingMessage.
     *
     * @param string|null $trackingMessage
     *
     * @return void
     */
    public function setTrackingMessage(?string $trackingMessage): TrackerInterface;

    /**
     * Getter for CreateAt.
     *
     * @return string|null
     */
    public function getCreateAt(): ?string;

    /**
     * Setter for CreateAt.
     *
     * @param string|null $createAt
     *
     * @return void
     */
    public function setCreateAt(?string $createAt): TrackerInterface;

    /**
     * Getter for Sku.
     *
     * @return string|null
     */
    public function getSku(): ?string;

    /**
     * Setter for Sku.
     *
     * @param string|null $sku
     *
     * @return void
     */
    public function setSku(?string $sku): TrackerInterface;
}
