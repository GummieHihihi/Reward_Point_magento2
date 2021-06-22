<?php
namespace Reward\Point\Controller\Adminhtml\EarningRules;

class Save extends \Reward\Point\Controller\Adminhtml\Vendor {
	protected $_imageHelper;

	public function __construct(
		\Magento\Backend\App\Action\Context $context) {
		parent::__construct($context);

	}

	public function execute() {

		$data = $this->getRequest()->getPostValue();
		$ruleId = (int) $this->getRequest()->getParam('ruleid');
		$resultRedirect = $this->resultRedirectFactory->create();
		//var_dump($data);
		// die('test data');4

		if ($data) {
			if ($ruleId) {

				$earningrule_model = $this->_objectManager->create('Reward\Point\Model\EarningRules')->load($ruleId);
			} else {

				$earningrule_model = $this->_objectManager->create('Reward\Point\Model\EarningRules');
			}
			$earningrule_model->setData($data);

			$date = time();
			$earningrule_model->setData('start', $date);
			$earningrule_model->setData('end', $date);
			$earningrule_model->setData('website', $data['website'][0]);
			$earningrule_model->setData('customer_group', $data['customer_group'][0]);
			// var_dump($earningrule_model->getData());
			$earningrule_model->save();

			if ($this->getRequest()->getParam('back') == 'edit') {
				return $resultRedirect->setPath('*/*/edit', ['id' => $vendor_model->getId()]);
			}

			return $resultRedirect->setPath('*/*/');
		}
	}
}
