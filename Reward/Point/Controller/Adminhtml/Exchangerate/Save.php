<?php
namespace Reward\Point\Controller\Adminhtml\Exchangerate;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Reward\Point\Controller\Adminhtml\Vendor
{
    protected $_imageHelper;

    public function __construct(
        \Magento\Backend\App\Action\Context $context)
    {
        parent::__construct($context);
        
        
    }

    public function execute()
    {

        $data = $this->getRequest()->getPostValue();    var_dump($data);
        
        $exchangeid = (int)$this->getRequest()->getParam('exchangeid');
        $resultRedirect = $this->resultRedirectFactory->create();
        //var_dump($data);
         // die('test data');4
        
        
        
        if ($data) {
            if($exchangeid){

                $exchangerate_model = $this->_objectManager->create('Reward\Point\Model\ExchangeRate')->load($exchangeid);
            }
            else{
                
                $exchangerate_model = $this->_objectManager->create('Reward\Point\Model\ExchangeRate');
            }
            $exchangerate_model->setData($data);
            // var_dump($earningrule_model->getData());
            $exchangerate_model->save();
            
            if ($this->getRequest()->getParam('back') == 'edit') {
                return  $resultRedirect->setPath('*/*/edit', ['id' =>$vendor_model->getId()]);
            }
            
        return $resultRedirect->setPath('*/*/');
    }
    }
}
