<?php
namespace Reward\Point\Model\ResourceModel\ExchangeRate;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    protected $_idFieldName = 'exchangeid';
    public function _construct(){
        parent::_construct();
        $this->_init('Reward\Point\Model\ExchangeRate', 'Reward\Point\Model\ResourceModel\ExchangeRate');
    }
}