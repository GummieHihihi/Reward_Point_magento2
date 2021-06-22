<?php
namespace Reward\Point\Model\ResourceModel\ClientPoint;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    protected $_idFieldName = 'client_point_id';
    public function _construct(){
        parent::_construct();
        $this->_init('Reward\Point\Model\ClientPoint', 'Reward\Point\Model\ResourceModel\ClientPoint');
    }
}