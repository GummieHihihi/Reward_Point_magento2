<?php
namespace Reward\Point\Block\Adminhtml\Customer\Tab;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;
/**
 * Customer account form block
 */
class CustomerEdit extends Generic implements TabInterface
{
     /**
     * @var \Magento\Store\Model\System\Store
     */
     protected $_systemStore;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,

        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Reward Point');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Reward Point');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
     if ($this->getCustomerId()) {
        return false;
    }
    return true;
}

    /**
     * Tab class getter
     *
     * @return string
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        return '';
    }

    /**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }

    public function initForm()
    {
        if (!$this->canShowTab()) {
            return $this;
        }
        /**@var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        
        
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Reward Point')]);

        $fieldset->addField('website', 'select', array(
            'label'     => __('Main Website'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'website',
            'data-form-part' => 'customer_form',
            'options' => array(
                
                'Main Website' => 'Main Website',
                
            ),
            'disabled' => false,
        ));

        $fieldset->addField(
            'update_balance',
            'text',
            [
                'name' => 'update_balance',
                'data-form-part' => 'customer_form',
                'label' => __('Update Balance'),
                'title' => __('Update Balance'),
                'class'     => 'required-entry',
                'after_element_html' => '<small>Enter positive or negative number of points. E.g. 10 or -10</small>'
            ]
        );
        $fieldset->addField(
            'note',
            'text',
            [
                'data-form-part' => 'customer_form',
                'name' => 'note',
                'class'     => 'required-entry',
                
                'label' => __('Note'),
                'title' => __('Note')
                
            ]
        );
        $this->setForm($form);
        return parent::_prepareForm();
    }
    /**
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->canShowTab()) {
            $this->initForm('customer_form');
            return parent::_toHtml();
        } else {
            return '';
        }
    }
    /**
     * Prepare the layout.
     *
     * @return $this
     */
// You can call other Block also by using this function if you want to add phtml file.
   // public function getFormHtml() 
   //  {
   //      $html = parent::getFormHtml();
   //      $html .= $this->getLayout()->createBlock(
   //          'Webkul\CustomerEdit\Block\Adminhtml\Customer\Edit\Tab\EdditionalBlock'
   //      )->toHtml();
   //      return $html;
   //  }
}