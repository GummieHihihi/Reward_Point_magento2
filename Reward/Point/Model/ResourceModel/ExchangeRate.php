<?php
namespace Reward\Point\Model\ResourceModel;
/**
 * Class Vendor
 * @package Magestore\Multivendor\Model\ResourceModel
 */
class ExchangeRate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    protected function _construct()	{
        $this->_init('exchange_rate', 'exchangeid');
    }
}