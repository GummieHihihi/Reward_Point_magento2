<?php

namespace Reward\Point\Controller\ExchangeRule;
use Magento\Framework\Controller\ResultFactory;
use Reward\Point\Model\Quote\Discount;

/**
 * Class NewAction
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class ChangePoint extends \Magento\Framework\App\Action\Action
{
    /**
     * @return mixed
     */
    protected $quote;
    protected $shippingAssignment;
    protected $total;
    protected $cart;
    protected $_coreSession;
    public function __construct(
    	\Magento\Framework\App\Action\Context $context,
    	\Magento\Quote\Model\Quote $quote,
    	\Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
      \Magento\Quote\Model\Quote\Address\Total $total,
      \Magento\Checkout\Model\Cart $cart,
      \Magento\Framework\Session\SessionManagerInterface $coreSession
  ) {
    	$this->quote = $quote;
    	$this->shippingAssignment = $shippingAssignment;
    	$this->total = $total;
      $this->cart = $cart;
    	parent::__construct($context);
      $this->_coreSession = $coreSession;
    }
    public function execute()
    {

        if(isset($_POST['point'])){
           $point = (is_numeric($_POST['point']) ? (int)$_POST['point'] : 0);
        }
        else{
            $point = 0;
        }

        if(isset($_POST['rate'])){
           $rate = (is_numeric($_POST['rate']) ? (int)$_POST['rate'] : 0);
        }
        $money = $point/$rate;
        
    	//Get Object Manager Instance
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
       $this->_coreSession->setData("point", $point);
       $this->_coreSession->setData("money", $money);
       $discountModel = $objectManager->get('\Reward\Point\Model\Quote\Discount');
       $this->cart->getQuote()->collectTotals()->save();
       $resultRedirect = $this->resultRedirectFactory->create();
       return $resultRedirect->setPath('checkout/cart/');

   }
}