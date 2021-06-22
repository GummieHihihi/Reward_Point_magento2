<?php
namespace Reward\Point\Controller\Adminhtml;
/**
 * Class Vendor
 * @package Magestore\Multivendor\Controller\Adminhtml
 */
abstract class Vendor extends \Magento\Backend\App\Action
{
    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(\Magento\Backend\App\Action\Context $context)
    {
        parent::__construct($context);
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Duong_Demo::vendor_manage');
    }
    public function beforeSave()
    {
        if (!$this->getId()) {
            $this->setCreatedAt($this->_dateFactory->create()->gmtDate());
        } else {
            $this->setUpdatedAt($this->_dateFactory->create()->gmtDate());
        }

        return parent::beforeSave();
    }
}