<?php

namespace Reward\Point\Block\Adminhtml\EarningRules;

/**
 * Class Edit
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container {

	/**
	 * @var \Magento\Framework\Registry|null
	 */
	protected $_coreRegistry = null;

	/**
	 * @param \Magento\Backend\Block\Widget\Context $context
	 * @param \Magento\Framework\Registry $registry
	 * @param array $data
	 */
	public function __construct(
		\Magento\Backend\Block\Widget\Context $context,
		\Magento\Framework\Registry $registry,
		array $data = []
	) {
		$this->_coreRegistry = $registry;
		parent::__construct($context, $data);
	}
	protected function _construct() {
		$this->_objectId = 'ids';
		//group cua block, khai bao trong layout
		$this->_blockGroup = 'Reward_Point';
		//controller -> dan den 1 block khac : Reward/Point/Block/Adminhtml/EarningRules/edit/form, tinh goc tu file Block
		//class nay ke thua form/container -> no se tu tim den file form trong folder nay
		$this->_controller = 'adminhtml_EarningRules';

		parent::_construct();

		$this->buttonList->update('save', 'label', __('Save'));
		$this->buttonList->update('delete', 'label', __('Delete'));
		$this->buttonList->add(
			'saveandcontinue',
			array(
				'label' => __('Save and Continue Edit'),
				'class' => 'save',
				'data_attribute' => array(
					'mage-init' => array('button' => array('event' => 'saveAndContinueEdit', 'target' => '#edit_form')),
				),
			),
			-100
		);

	}
	public function getHeaderText() {
		if ($this->_coreRegistry->registry('current_vendor')->getId()) {
			return __("Edit Vendor '%1'", $this->escapeHtml($this->_coreRegistry->registry('current_vendor')->getData('display_name')));
		} else {
			return __('New Vendor');
		}
	}

}