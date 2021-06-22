<?php
namespace Reward\Point\Block\Frontend\Checkout;
class ExchangeRules extends \Magento\Framework\View\Element\Template
{
    protected $_objectManager;
    protected $_storeManager;
    protected $connection;
    protected $total;
    protected $_registry;
    const STATUS_ENABLED = 1;
    const TYPE_GIVE = 'give';
    const Type_exchange = 'exchange';
    

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Quote\Model\Quote\Address\Total $total,
        array $data
    )
    {
        $this->_objectManager = $objectManager;
        $this->_storeManager = $context->getStoreManager();
        parent::__construct($context, $data);
        $this->connection = $resource->getConnection();
        $this->total = $total;
    }
    public function getCustomerId()
    {
        $id = $this->getRequest()->getParam('id');
        $customer = $this->_objectManager->create('\Magento\Customer\Model\Session');
        $collection = $customer->getData()['customer_id'];
        
        return $collection;
    }
    
    public function getCustomerRewardPoint()
    { 
        $query = $this->connection->fetchAll("SELECT client_point FROM clientpoint_demo Where entity_id = ".$this->getCustomerId());
        return $query;
    }
    public function getStoreManager(){
        return $this->_storeManager;
    }

    public function getAllRules(){
        $allRules = array();
        $availibble = $this->connection->fetchAll("SELECT * FROM exchange_rate");
        return $availibble;
    }
    public function getHighestRules(){
        $highestRules = null;
        if(count($this->getAllRules()) == 1){
            $highestRules = $this->getAllRules()[0];
        }
        else{
            for($i =0; $i<count($this->getAllRules())-1;$i++)
            if($this->getAllRules()[$i]['priority']<$this->getAllRules()[$i+1]['priority']){
                $highestRules = $this->getAllRules()[$i+1]['priority'];
            }
        }
        return $highestRules;
    }
}