<?php

namespace Magenest\Movie\Model\ResourceModel\MovieActor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magenest\Movie\Model\ResourceModel\MovieActor as ResourceModel;
use Magenest\Movie\Model\MovieActor as Model;

class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
