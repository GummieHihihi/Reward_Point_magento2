<?php

namespace Reward\Point\Controller\Adminhtml\Customer;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class NewAction
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class Grid extends \Reward\Point\Controller\Adminhtml\Vendor
{
    /**
     * @return mixed
     */
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        die('here in controller');
    }
}