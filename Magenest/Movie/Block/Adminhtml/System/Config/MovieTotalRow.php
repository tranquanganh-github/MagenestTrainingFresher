<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as MovieCollectionFactory;
use Magento\Backend\Block\Context;
use Magento\Config\Block\System\Config\Form\Field\Heading;
use Magento\Framework\Data\Form\Element\AbstractElement;

class MovieTotalRow extends Heading
{
    /**
     * @var MovieCollectionFactory
     */
    protected MovieCollectionFactory $movieCollectionFactory;

    /**
     * @param Context $context
     * @param MovieCollectionFactory $movieCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context                $context,
        MovieCollectionFactory $movieCollectionFactory,
        array                  $data = []
    ) {
        parent::__construct($context, $data);
        $this->movieCollectionFactory = $movieCollectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $label = $element->getLabel();
        $collection = $this->movieCollectionFactory->create();
        /**@var $collection \Magenest\Movie\Model\ResourceModel\Movie\Collection */
        $totalMovies = $collection->getSize();
        $info = "<p>" . __("Total movies is: ") . $totalMovies . "</p>";
        $label .= $info;

        return sprintf(
            '<tr class="system-fieldset-sub-head" id="row_%s"><td colspan="5"><h4 id="%s">%s</h4></td></tr>',
            $element->getHtmlId(),
            $element->getHtmlId(),
            $label
        );
    }
}
