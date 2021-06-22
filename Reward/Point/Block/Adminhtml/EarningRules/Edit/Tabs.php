<?php

namespace Reward\Point\Block\Adminhtml\EarningRules\Edit;

/**
 * Class Tabs
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{


    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('rewardpointadmin_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Rule info '));
    }


    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {

        $this->addTab(
            'earningrules_form',
            [
                'label' => __('Rule information'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock('Reward\Point\Block\Adminhtml\EarningRules\Edit\Tab\Form')
                ->toHtml(),
                'active' => true
            ]
        );

        $this->addTab(
            'condition',
            [
                'label' => __('Condition'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock('Reward\Point\Block\Adminhtml\EarningRules\Edit\Tab\Condition')
                ->toHtml(),
                'active' => false
            ]
        );

        $this->addTab(
            'action',
            [
                'label' => __('Action'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock('Reward\Point\Block\Adminhtml\EarningRules\Edit\Tab\Action')
                ->toHtml(),
                'active' => false
            ]
        );
        $this->addTab(
            'note',
            [
                'label' => __('Notes'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock('Reward\Point\Block\Adminhtml\EarningRules\Edit\Tab\Note')
                ->toHtml(),
                'active' => false
            ]
        );
        return parent::_beforeToHtml();
    }

}