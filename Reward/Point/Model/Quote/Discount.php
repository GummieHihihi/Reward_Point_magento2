<?php
namespace Reward\Point\Model\Quote;
class Discount extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
	protected $_registry;
	protected $_coreSession;
	public function __construct(
		\Magento\Framework\Event\ManagerInterface $eventManager,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\SalesRule\Model\Validator $validator,
		\Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
		\Magento\Framework\Registry $registry,
		\Magento\Framework\App\ResourceConnection $resource,
		\Magento\Framework\Session\SessionManagerInterface $coreSession
	) 
	{
		$this->setCode('testdiscount');
		$this->eventManager = $eventManager;
		$this->calculator = $validator;
		$this->storeManager = $storeManager;
		$this->priceCurrency = $priceCurrency;
		$this->_registry = $registry;
		$this->connection = $resource->getConnection();
		$this->_coreSession = $coreSession;
	}

	public function collect(
		\Magento\Quote\Model\Quote $quote,
		\Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
		\Magento\Quote\Model\Quote\Address\Total $total
	)
	{
		
		
		parent::collect($quote, $shippingAssignment, $total);
		$address = $shippingAssignment->getShipping()->getAddress();
		$label = 'Reward Points';
		
		$TotalAmount=$this->_coreSession->getData("money");
		if($TotalAmount){
			$TotalAmount=$this->_coreSession->getData("money");
		}
		else{
			$TotalAmount = 0;
		}

		$discountAmount = '-'. $TotalAmount; 
		// die(var_dump($discountAmount));

		$appliedCartDiscount = 0;
		if($total->getDiscountDescription())
		{
			$appliedCartDiscount = $total->getDiscountAmount();
			$discountAmount = int($total->getDiscountAmount() + $discountAmount);
			$label = $total->getDiscountDescription().', '.$label;
		} 

		$total->setDiscountDescription($label);
		$total->setDiscountAmount($discountAmount);
		$total->setBaseDiscountAmount($discountAmount);
		$total->setSubtotalWithDiscount($total->getSubtotal() + $discountAmount);


		$total->setBaseSubtotalWithDiscount($total->getBaseSubtotal() + $discountAmount);

		if(isset($appliedCartDiscount))
		{
			$total->addTotalAmount($this->getCode(), $discountAmount - $appliedCartDiscount);
			$total->addBaseTotalAmount($this->getCode(), $discountAmount - $appliedCartDiscount);
		} 
		else 
		{
			$total->addTotalAmount($this->getCode(), $discountAmount);
			$total->addBaseTotalAmount($this->getCode(), $discountAmount);
		}

		return $this;
	}

	public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
	{
		$result = null;
		$amount = $total->getDiscountAmount();
		

		if ($amount != 0)
		{ 
			$description = $total->getDiscountDescription();
			$result = [
				'code' => $this->getCode(),
				'title' => strlen($description) ? __('Reward Point ') : __('Reward Point'),
				'value' => $amount
			];
		}
		return $result;
		//(%1)', $description
	}
	public function saveTempDiscount($point, $money){
		$sql = "INSERT INTO temp_discount(point, money) VALUES ($point, $money)";
		$q = $this->connection->query($sql);
	}
	public function getTempPoint(){
		$temp_id = $this->connection->fetchAll("SELECT * FROM temp_discount ORDER BY discountid DESC limit 1");
		return $temp_id;
	}

}