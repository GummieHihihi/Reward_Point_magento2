<?php
// FOR JAVASCRIPT FILES

namespace Reward\Point\Block\Adminhtml\EarningRules\Edit\Tab;
/**
 * Class Form
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit\Tab
 */
class Note extends \Magento\Backend\Block\Widget\Form\Generic
implements \Magento\Backend\Block\Widget\Tab\TabInterface
{

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = array()
    )
    {
        $this->_objectManager = $objectManager;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout() {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());
    }


    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {

        $model = $this->_coreRegistry->registry('current_vendor');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Store View Specific Notes ')));

        if ($model->getVendorId()) {
            $fieldset->addField('ruleid','hidden', array('name' => 'ruleid'));
        }

        $fieldset->addField('note_storeview', 'textarea', array(
          'label'     => __('note for all the Store View'),
          'class'     => '',
          'required'  => false,
          'name'      => 'note_storeview',
          'onclick' => "",
          'onchange' => "",
          'value'  => '<b><b/>',
          'disabled' => false,
          
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
        $fieldset->addField('default_storeview', 'textarea', array(
          'label'     => __('Default store view'),
          'class'     => '',
          'required'  => false,
          'name'      => 'default_storeview',
          'onclick' => "",
          'onchange' => "",
          'value'  => '<b><b/>',
          'disabled' => false,
          
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));

        

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @return mixed
     */
    public function getVendor() {
        return $this->_coreRegistry->registry('current_vendor');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getPageTitle() {
        return $this->getVendor()->getId() ? __("Edit Vendor %1",
            $this->escapeHtml($this->getVendor()->getDisplayName())) : __('New Vendor');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Vendor Information');
    }


    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Vendor Information');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }


}
?>

