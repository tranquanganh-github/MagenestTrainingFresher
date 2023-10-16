<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as ActorCollectionFactory;
use Magento\Backend\Block\Context;
use Magento\Config\Block\System\Config\Form\Field\Heading;
use Magento\Framework\Data\Form\Element\AbstractElement;

class ActorTotalRow extends Heading
{
    /**
     * @var ActorCollectionFactory
     */
    protected ActorCollectionFactory $actorCollectionFactory;

    /**
     * @param Context $context
     * @param ActorCollectionFactory $actorCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context                $context,
        ActorCollectionFactory $actorCollectionFactory,
        array                  $data = []
    ) {
        parent::__construct($context, $data);
        $this->actorCollectionFactory = $actorCollectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $label = $element->getLabel();
        $collection = $this->actorCollectionFactory->create();
        /**@var $collection \Magenest\Movie\Model\ResourceModel\Movie\Collection */
        $totalMovies = $collection->getSize();
        $info = "<p>" . __("Total actor is: ") . $totalMovies . "</p>";
        $label .= $info;

        return sprintf(
            '<tr class="system-fieldset-sub-head" id="row_%s"><td colspan="5"><h4 id="%s">%s</h4></td></tr>',
            $element->getHtmlId(),
            $element->getHtmlId(),
            $label
        );
    }
}
