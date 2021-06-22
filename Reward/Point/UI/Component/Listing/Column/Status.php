<?php
namespace Reward\Point\UI\Component\Listing\Column;
use Magento\Framework\Data\OptionSourceInterface;
class Status implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['label' => __('Enabled'),'value' => 1],
            ['label' => __('Disabled'),'value' => 2],
        ];
    }
}