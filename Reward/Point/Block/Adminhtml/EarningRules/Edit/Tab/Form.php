<?php
namespace Reward\Point\Block\Adminhtml\EarningRules\Edit\Tab;
/**
 * Class Form
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit\Tab
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
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
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Rule Information')));

        if ($model->getruleid()) {
            $fieldset->addField('ruleid','hidden', array('name' => 'ruleid'));
        }

        $fieldset->addField('rule_name', 'text', array(
            'label'     => __('Rule Name :'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'rule_name',
            'disabled' => false,
        ));
        $fieldset->addField('priority', 'text', array(
            'label'     => __('Priority :'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'priority',
            'disabled' => false,
            'after_element_html' => '<small>the smaller this is the higher is the priority of the rule </small>',
            'placeholder' => 'from 1 to 100'
        ));
        

        $fieldset->addField(
            'start',
            'date',
            [
                'name' => 'start',
                'label' => __('Start Date'),
                'id' => 'start_date',
                'title' => __('Start Date'),
                'date_format' => 'yyyy-MM-dd',
                'required' => true            
            ]
        );

        $fieldset->addField(
            'end',
            'date',
            [
                'name' => 'end',
                'label' => __('end Date'),
                'id' => 'start_date',
                'title' => __('end Date'),
                'date_format' => 'yyyy-MM-dd',
                'required' => true            
            ]
        );

        


       // $fieldset->addField('website', 'select', array(
       //    'label'     => __('website :'),
       //    'class'     => 'required-entry',
       //    'required'  => true,
       //    'name'      => 'website',
       //    'onclick' => "",
       //    'onchange' => "",
       //    'value'  => '1',
       //    'values' => array('-1'=>'Please Select..','1' => 'Main Website'),
       //    'disabled' => false,
          
       //    'tabindex' => 1
       //  )); 
        $fieldset->addField('website', 'multiselect', array(
          'label'     => __('Website'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'website',
          'onclick' => "return false;",
          'onchange' => "return false;",
          
          'values' => array(
                                '-1'=> array( 'label' => 'Please Select..', 'value' => '-1'),
                                '1' => array('label'=>'Main Website',  'value'=> 'Main Website')                                       
                           ),
          'disabled' => false,
          'readonly' => false,
          
          'tabindex' => 1
        ));

        $fieldset->addField('customer_group', 'multiselect', array(
          'label'     => __('Customer Group :'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'customer_group',
          'onclick' => "return false;",
          'onchange' => "return false;",
          
          'values' => array(
                                '-1'=> array( 'label' => 'Please Select..', 'value' => '-1'),
                                '1' => array('label'=>'General',  'value'=> 'All'),
                                  '2' => array('label'=>'Whole sale',  'value'=> 'wholesale'),
                                  '3' => array('label'=>'retailer',  'value'=> 'retailer')                                     
                           ),
          'disabled' => false,
          'readonly' => false,
          
          'tabindex' => 1
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => __('Status'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'status',
            'options' => array(
                '-1'=>'select a status',
                1 => 'Enabled',
                2 => 'Disabled',
            ),
            'disabled' => false,
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