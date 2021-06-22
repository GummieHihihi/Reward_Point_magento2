<?php
namespace Reward\Point\Block\Frontend\Checkout;
class EarningRules extends \Magento\Framework\View\Element\Template
{
    protected $_objectManager;
    protected $_storeManager;
    protected $connection;
    protected $total;
    protected $coreSession;
    const STATUS_ENABLED = 1;
    const TYPE_GIVE = 'give';
    const Type_exchange = 'exchange';

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Quote\Model\Quote\Address\Total $total,
        \Magento\Framework\Session\SessionManagerInterface $coreSession,
        array $data
    )
    {
        $this->_objectManager = $objectManager;
        $this->_storeManager = $context->getStoreManager();
        parent::__construct($context, $data);
        $this->connection = $resource->getConnection();
        $this->total = $total;
        $this->coreSession = $coreSession;
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

    public function getAllRules(){
        $allRules = array();
        $availibble = $this->connection->fetchAll("SELECT * FROM earning_rules");
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


    public  function getGiveRules()
    {
        $availibble = $this->connection->fetchAll("SELECT ruleid FROM earning_rules Where status = ".self::STATUS_ENABLED );
        $giveRules = $this->connection->fetchAll("SELECT ruleid FROM earning_rules Where type = 'give'");
        if($availibble && $giveRules){
            $allow = array();
            for($i =0; $i<count($availibble);$i++)
            {
                for($j=0; $j<count($giveRules); $j++)
                {
                    if($availibble[$i]['ruleid'] === $giveRules[$j]['ruleid']){
                        array_push($allow, $availibble[$i]['ruleid']);
                    }
                }
            }
        }
        else{
            return null;
        }
        return $allow;
    }
    public function getTotal(){
        $cart = $this->_objectManager->get('\Magento\Checkout\Model\Cart'); 
        $subTotal = $cart->getQuote()->getSubtotal();
        return $subTotal;
    }

    public function addGiveRewardPoint($number){
        $query = $this->connection->fetchAll("SELECT client_point_id FROM clientpoint_demo Where entity_id = ".$this->getCustomerId());
        $oldPoint = $this->connection->fetchAll("SELECT client_point FROM clientpoint_demo Where entity_id = ".$this->getCustomerId());

        $newPoint = $oldPoint[0]['client_point'] + $number;

        $sql = "UPDATE clientpoint_demo SET client_point = '$newPoint' WHERE entity_id = ".$query[0]['client_point_id'];
        $q = $this->connection->query($sql);
    }

    public function minusRewardPoint($number){
        $query = $this->connection->fetchAll("SELECT client_point_id FROM clientpoint_demo Where entity_id = ".$this->getCustomerId());
        $oldPoint = $this->connection->fetchAll("SELECT client_point FROM clientpoint_demo Where entity_id = ".$this->getCustomerId());

        $newPoint = $oldPoint[0]['client_point'] - $number;

        $sql = "UPDATE clientpoint_demo SET client_point = '$newPoint' WHERE entity_id = ".$query[0]['client_point_id'];
        $q = $this->connection->query($sql);
    }

    public function saveTemp($number, $status){
        $sql = "INSERT INTO temp_trans(total, status) VALUES ($number, $status)";
        $q = $this->connection->query($sql);
    }

    public function getTempTotal(){
        $temp_id = $this->connection->fetchAll("SELECT total FROM temp_trans ORDER BY temp_id DESC limit 1");
        return $temp_id;
    }
    



    // public function getAllGiveRate()
    // {   
    //     if($this->getGiveRules()){
    //         $total = 0;
    //         for($i=0;$i<count($this->getGiveRules());$i++){

    //             $rate = $this->connection->fetchAll("SELECT receive_point FROM earning_rules Where ruleid = " .$this->getGiveRules()[$i]);
    //             $ratetoint = (int)$rate[0]['receive_point'];
    //             $total += $ratetoint;
    //         }
    //         return (int)$rate[0]['receive_point'];
    //     }
    //     else{
    //         return 0;
    //     }
        
    // }

    // public function getExchangeRules(){
    //     $availibble = $this->connection->fetchAll("SELECT ruleid FROM earning_rules Where status = ".self::STATUS_ENABLED );
    //     $giveRules = $this->connection->fetchAll("SELECT ruleid FROM earning_rules Where type = 'exchange'");

    //     $allow = array();
    //     for($i =0; $i<count($availibble);$i++)
    //     {
    //         for($j=0; $j<count($giveRules); $j++)
    //         {
    //             if($availibble[$i]['ruleid'] === $giveRules[$j]['ruleid']){
    //                 array_push($allow, $availibble[$i]['ruleid']);
    //             }
    //         }
    //     }
    //     return $allow;
    // }


    public function getMediaUrlImage($imagePath = '')
    {
        return $this->_storeManager->getStore()
        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $imagePath;
    }
    public function setSessionData($name, $value){
        $this->coreSession->setData($name, $value);
    }
    public function getSessionData($name){
        return $this->coreSession->getData($name);
    }
    
}