<?php
namespace Reward\Point\Plugin;

/**
 * Class AddDataToOrdersGrid
 */
class GridJoinCollection
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * AddDataToOrdersGrid constructor.
     *
     * @param \Psr\Log\LoggerInterface $customLogger
     * @param array $data
     */
    public function __construct(
    	\Psr\Log\LoggerInterface $customLogger,
    	array $data = []
    ) {
    	$this->logger   = $customLogger;
    }

    /**
     * @param \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject
     * @param \Magento\Sales\Model\ResourceModel\Order\Grid\Collection $collection
     * @param $requestName
     * @return mixed
     */
    public function afterGetReport($subject, $collection, $requestName)
    {

    	if ($requestName !== 'customer_listing_data_source') {
    		return $collection;
    	}
    	else if($requestName == 'customer_listing_data_source')
    	{

    		$select = $collection->getSelect();
    		$select->joinLeft(
    			["secondTable" => $collection->getTable("clientpoint_demo")],
    			'main_table.entity_id = secondTable.client_point_id',
    			array('client_point')
    		);
    		// var_dump($collection->toArray());
    	}
    	return $collection;
    }
}