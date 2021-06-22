<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Multivendor
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */
namespace Reward\Point\Controller\Adminhtml\Exchangerate;

class Delete extends \Reward\Point\Controller\Adminhtml\Vendor
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $vendorId = $this->getRequest()->getParam('id');
        
        if ($vendorId > 0) {
            $modelEarningRules = $this->_objectManager->create('Reward\Point\Model\ExchangeRate')
                ->load($this->getRequest()->getParam('id'));
            try {
                $modelEarningRules->delete();
                $this->messageManager->addSuccess(__('this rule was successfully deleted'));

            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}