<?php
namespace Reward\Point\Model\ResourceModel;
/**
 * Class Vendor
 * @package Magestore\Multivendor\Model\ResourceModel
 */
class EarningRules extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    protected function _construct()	{
        $this->_init('earning_rules', 'ruleid');
    }
}