<?php

namespace Reward\Point\Controller\Adminhtml\earningRules;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class NewAction
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class NewAction extends \Reward\Point\Controller\Adminhtml\Vendor
{
    /**
     * @return mixed
     */
    public function execute()
    {
    	
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        return $resultForward->forward('edit');
    }
}