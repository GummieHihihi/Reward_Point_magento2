<?php

namespace Reward\Point\Block\Adminhtml\ExchangeRate\Edit;

/**
 * Class Form
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        //khai bao thuoc tinh post cua cai form o lop tren
        $form = $this->_formFactory->create(
            array(
                'data' => array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', ['store' => $this->getRequest()->getParam('store')]),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                )
            )
        );
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Exchange Rate Information')));
        $model = $this->_coreRegistry->registry('current_vendor');
        if ($model->getexchangeid()) {
            $fieldset->addField('exchangeid','hidden', array('name' => 'exchangeid'));
        }

        $fieldset->addField('website', 'select', array(
            'label'     => __('website'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'website',
            'options' => array(
                'ALL WEBSITE'=>'ALL WEBSITE',
                'Main Website' => 'Main Website'
            ),
            'disabled' => false,
        ));

        $fieldset->addField('cusstomerGroup', 'select', array(
            'label'     => __('Customer Group :'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'cusstomerGroup',
            'options' => array(
                'ALL GROUP'=>'ALL GROUP',
                'General' => 'General',
                'Wholesale' => 'Wholesale',
                'Retailer' => 'Retailer'
            ),
            'disabled' => false,
        ));

        $fieldset->addField('priority', 'text', array(
            'label'     => __('Priority'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'priority',
            'after_element_html' => '<small>the smaller this is the higher is the priority of the rule </small>',
            'disabled' => false,
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
        $fieldset->addField('exchangeRate', 'text', array(
            'label'     => __('Exchange Rate :'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'exchangeRate',
            'disabled' => false,
            'after_element_html' => '<small>10 means that 10 points = $1 (the default base currency is USD)</small>',
        ));
        

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}