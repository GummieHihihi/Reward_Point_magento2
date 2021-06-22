<?php
namespace Reward\Point\Model\ResourceModel;
/**
 * Class Vendor
 * @package Magestore\Multivendor\Model\ResourceModel
 */
class ClientPoint extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    protected function _construct()	{
        $this->_init('clientpoint_demo', 'client_point_id');
    }
}