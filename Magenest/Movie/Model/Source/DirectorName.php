<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Model\Source;

use Magenest\Movie\Api\Data\DirectorInterface;
use Magenest\Movie\Model\ResourceModel\Director\Collection;
use Magento\Customer\Model\Customer\Source\GroupSourceInterface;
use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory as DirectorCollectionFactory;

class DirectorName implements GroupSourceInterface
{
    /**
     * @var DirectorCollectionFactory
     */
    protected DirectorCollectionFactory $directorCollectionFactory;

    /**
     * @param DirectorCollectionFactory $directorCollectionFactory
     */
    public function __construct(
        DirectorCollectionFactory $directorCollectionFactory
    ) {
        $this->directorCollectionFactory = $directorCollectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $directorGroups = [];

        /** @var $collection Collection */
        $collection = $this->directorCollectionFactory->create();
        $director = $collection->getData();
        foreach ($director as $item) {
            $directorGroups[] = [
                'label' => $item[DirectorInterface::DIRECTOR_NAME],
                'value' => $item[DirectorInterface::DIRECTOR_ID],
            ];
        }

        return $directorGroups;
    }
}
