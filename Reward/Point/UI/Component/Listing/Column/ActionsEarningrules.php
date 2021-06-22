<?php
namespace Reward\Point\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class ActionsEarningrules extends Column {
	/** @var UrlInterface */
	protected $urlBuilder;

	/**
	 * @var string
	 */
	private $editUrl;
	private $deleteUrl;

	/**
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param UrlInterface $urlBuilder
	 * @param array $components
	 * @param array $data
	 * @param string $editUrl
	 */
	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		UrlInterface $urlBuilder,
		array $components = [],
		array $data = []
	) {
		$this->urlBuilder = $urlBuilder;
		$this->editUrl = $data['vendorUrlPathEdit'];
		$this->deleteUrl = $data['vendorUrlPathDelete'];

		parent::__construct($context, $uiComponentFactory, $components, $data);
	}

	/**
	 * Prepare Data Source
	 *
	 * @param array $dataSource
	 * @return array
	 */
	public function prepareDataSource(array $dataSource) {
		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as &$item) {
				$name = $this->getData('name');
				if (isset($item['ruleid'])) {
					// die('123');
					$item[$name]['edit'] = [
						'href' => $this->urlBuilder->getUrl($this->editUrl, ['id' => $item['ruleid']]),
						'label' => __('Edit'),
					];
					$item[$name]['delete'] = [
						'href' => $this->urlBuilder->getUrl($this->deleteUrl, ['id' => $item['ruleid']]),
						'label' => __('Delete'),
					];
				}
			}
		}
		return $dataSource;
	}
}