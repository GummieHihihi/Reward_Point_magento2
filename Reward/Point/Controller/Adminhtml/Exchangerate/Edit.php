<?php

namespace Reward\Point\Controller\Adminhtml\Exchangerate;
/**
 * Class Edit
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class Edit extends \Reward\Point\Controller\Adminhtml\Vendor
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory

    ) {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    /**
     * @return $this|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        
        $id = $this->getRequest()->getParam('id');
        // var_dump($this->getRequest()->getParam('id'));
        //die('123');
        $resultRedirect = $this->resultRedirectFactory->create();
        $model = $this->_objectManager->create('Reward\Point\Model\ExchangeRate');
        // var_dump($model->getName());
        // die('12');
        $registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        if ($id) {
            $model = $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This vendor no longer exists.'));
                return $resultRedirect->setPath('rewardpointadmin/*/', ['_current' => true]);
            }
        }
        

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        

        if (!empty($data)) {
            $model->setData($data);
        }
        $registryObject->register('current_vendor', $model);
        
        $resultPage = $this->_resultPageFactory->create();
        if (!$model->getId()) {
            $pageTitle = __('New Exchange Rate');
        } else {
            $pageTitle =  __('Edit This Exchange Rate %1', $model->getName());
        }
       
        $resultPage->getConfig()->getTitle()->prepend($pageTitle);
        //var_dump($pateTitle);
        
        return $resultPage;
    }

}