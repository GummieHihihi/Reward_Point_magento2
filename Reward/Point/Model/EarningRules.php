<?php
namespace Reward\Point\Model;
/**
 * Class Vendor
 * @package Reward\Point\Model
 */
class EarningRules extends \Magento\Framework\Model\AbstractModel
{
    protected $connection;
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\Vendor $resource
     * @param ResourceModel\Vendor\Collection $resourceCollection
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Reward\Point\Model\ResourceModel\EarningRules $resource,
        \Reward\Point\Model\ResourceModel\EarningRules\Collection $resourceCollection,
        \Magento\Framework\App\ResourceConnection $resourcefree
    )
    {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
        $this->connection = $resourcefree->getConnection();
    }

}