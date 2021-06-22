<?php
namespace Reward\Point\Model;
/**
 * Class Vendor
 * @package Reward\Point\Model
 */
class Transaction extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\Vendor $resource
     * @param ResourceModel\Vendor\Collection $resourceCollection
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Reward\Point\Model\ResourceModel\ExchangeRate $resource,
        \Reward\Point\Model\ResourceModel\ExchangeRate\Collection $resourceCollection
    )
    {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
    }
}