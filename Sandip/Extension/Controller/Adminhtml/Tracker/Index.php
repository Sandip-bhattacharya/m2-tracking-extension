<?php
declare(strict_types=1);

namespace Sandip\Extension\Controller\Adminhtml\Tracker;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Sandip\Extension\Api\TrackerRepositoryInterface;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var TrackerRepositoryInterface
     */
    private $trackerRepository;

    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @param Action\Context $context
     * @param Registry $coreRegistry
     * @param TrackerRepositoryInterface $trackerRepository
     */
    public function __construct(
        Action\Context $context,
        Registry $coreRegistry,
        TrackerRepositoryInterface $trackerRepository
    ) {
        parent::__construct($context);

        $this->trackerRepository = $trackerRepository;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Tracker Data'));
        return $resultPage;
    }
}
