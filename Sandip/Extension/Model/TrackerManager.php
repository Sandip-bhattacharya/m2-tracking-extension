<?php
declare(strict_types=1);

namespace Sandip\Extension\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\Adapter\CurlFactory;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;
use Sandip\Extension\Api\TrackerManagerInterface;
use Sandip\Extension\Api\TrackerRepositoryInterface;
use Sandip\Extension\Model\TrackerModelFactory;

class TrackerManager implements TrackerManagerInterface
{
    const XML_PATH_TRACKER_URL = 'tracker/general/tracker_url';

    /**
     * @var TrackerRepositoryInterface
     */
    private $trackerRepository;

    private $trackModel;

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var ScopeConfigInterface
     */
    private $config;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param TrackerRepositoryInterface $trackerRepository
     * @param TrackerModelFactory $trackerModel
     * @param CurlFactory $curl
     * @param ScopeConfigInterface $config
     * @param LoggerInterface $logger
     */
    public function __construct(
        TrackerRepositoryInterface $trackerRepository,
        TrackerModelFactory  $trackerModel,
        CurlFactory $curl,
        ScopeConfigInterface $config,
        LoggerInterface $logger
    ) {
        $this->trackerRepository = $trackerRepository;
        $this->trackModel = $trackerModel;
        $this->curl = $curl;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function track(string $sku, float $price): void
    {
        if (empty($sku) || empty($price)) {
            return;
        }

        try {
            $trackerUrl = $this->config->getValue(self::XML_PATH_TRACKER_URL, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
            if (!empty($trackerUrl)) {
                $params = json_encode([
                    'sku' => $sku,
                    'price' => $price
                ]);
                $httpAdapter = $this->curl->create();
                $httpAdapter->write(\Zend_Http_Client::POST, trim($trackerUrl), '1.1',
                    ["Content-Type:application/json", "Content-Length" => "200"], $params);
                $result = $httpAdapter->read();
                $this->saveTrack($result, $sku);
            }
        } catch (\Exception $exception) {
            $this->logger->critical(__('Tracker error - %1', $exception->getMessage()));
        }
    }

    /**
     * @param string $result
     * @param string $sku
     * @return void
     */
    private function saveTrack(string $result, string $sku): void
    {
        try {
            $track = $this->trackModel->create();
            $body = json_decode(\Zend_Http_Response::extractBody($result), true);
            $responseCode = \Zend_Http_Response::extractCode($result);
            $message = (isset($body['message']) && !empty($body['message'])) ? (string)$body['message'] : 'Tracking Unsuccessful';
            $code = (isset($body['code']) && !empty($body['code'])) ? (int)$body['code'] : 0;

            if ($responseCode == 200 && $code) {
                $track->setSku($sku)->setTrackingCode((int)$body['code'])->setTrackingMessage($message);
            } else {
                $track->setSku($sku)->setTrackingCode($code)->setTrackingMessage($message);
            }

            $this->trackerRepository->save($track);
        } catch (\Exception $exception) {
            $this->logger->critical(__('Tracker error - %1', $exception->getMessage()));
        }
    }
}
