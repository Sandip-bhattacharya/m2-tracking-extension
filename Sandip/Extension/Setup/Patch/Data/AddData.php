<?php
declare(strict_types=1);

namespace Sandip\Extension\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Sandip\Extension\Model\TrackerModelFactory;

class AddData implements DataPatchInterface
{
    private $trackerModel;
    public function __construct(TrackerModelFactory $trackerModel)
    {
        $this->trackerModel = $trackerModel;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $sampleData = [
            [
                'sku' => 'product-1',
                'tracking_code' => 2898928900,
                'tracking_message' => 'Tracking Successful'
            ],
            [
                'sku' => 'product-2',
                'tracking_code' => 2456378910,
                'tracking_message' => 'Tracking Successful'
            ]
        ];

        foreach ($sampleData as $data){
            $this->trackerModel->create()->setData($data)->save();
        }
    }
}
