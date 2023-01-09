<?php
declare(strict_types=1);

namespace Sandip\Extension\Api;

interface GetTrackerListInterface
{

    /**
     * @return \Sandip\Extension\Api\Data\TrackerInterface[]
     */
    public function execute();
}
