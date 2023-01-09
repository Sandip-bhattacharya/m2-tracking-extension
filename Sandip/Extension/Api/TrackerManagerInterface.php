<?php
declare(strict_types=1);

namespace Sandip\Extension\Api;

interface TrackerManagerInterface
{
    /**
     * @param string $sku
     * @param float $price
     * @return void
     */
    public function track(string $sku, float $price): void;
}
