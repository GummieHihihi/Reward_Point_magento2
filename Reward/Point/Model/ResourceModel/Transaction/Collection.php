<?php
namespace Reward\Point\Model\ResourceModel\Transaction;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    protected $_idFieldName = 'transid';
    public function _construct(){
        parent::_construct();
        $this->_init('Reward\Point\Model\Transaction', 'Reward\Point\Model\ResourceModel\Transaction');
    }
}