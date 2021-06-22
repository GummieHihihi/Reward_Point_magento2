<?php
namespace Reward\Point\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomerSave implements ObserverInterface {
	protected $_objectManager;
	protected $_customerCollectionFactory;
	protected $request;
	public function __construct(
		\Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory,
		\Magento\Framework\App\Request\Http $request,
		\Magento\Framework\ObjectManagerInterface $objectManager
	) {
		$this->_customerCollectionFactory = $customerCollectionFactory;
		$this->request = $request;
		$this->_objectManager = $objectManager;
	}

	/**
	 *
	 * @param \Magento\Framework\Event\Observer $observer
	 * @return void
	 */
	public function execute(\Magento\Framework\Event\Observer $observer) {
		$event = $observer->getEvent();
		$customerData = $event->getCustomer();
		$update = (int) $this->request->getPostValue()['update_balance'];
		$note = $this->request->getPostValue()['note'];
		$clientPointModel = $this->_objectManager->create('Reward\Point\Model\ClientPoint');
		$point = $clientPointModel->load($customerData->getId());
		$currenpoint = (int) $point->getData('client_point');
		$newPoint = $currenpoint + $update;
		// die(var_dump($newePoint));

		// set the data
		$customerInModel = $clientPointModel->load($customerData->getId());
		$customerInModel->setData('client_point', $newPoint);
		$customerInModel->save();

		$customerCollection = $this->_customerCollectionFactory->create();

	}

}
