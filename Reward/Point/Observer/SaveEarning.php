<?php
namespace Reward\Point\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveEarning implements ObserverInterface
{
	protected $_objectManager;
	protected $_storeManager;
	protected $connection;
	protected $total;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Framework\App\ResourceConnection $resource,
		\Magento\Quote\Model\Quote\Address\Total $total
	)
	{
		$this->_objectManager = $objectManager;
		$this->_storeManager = $context->getStoreManager();
		
		$this->connection = $resource->getConnection();
		$this->total = $total;
	}
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$this->setStatusTemp();
		 exit;

	}

	public function setStatusTemp(){
        $temp_id = $this->connection->fetchAll("SELECT temp_id FROM temp_trans ORDER BY temp_id limit 1");
        $sql = "UPDATE temp_trans SET status = 2 WHERE temp_id = ".$temp_id[0]['temp_id'];
        $q = $this->connection->query($sql);
        return $temp_id;
    }

}