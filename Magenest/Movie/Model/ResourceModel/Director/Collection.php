<?php

namespace Magenest\Movie\Model\ResourceModel\Director;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magenest\Movie\Model\ResourceModel\Director as ResourceModel;
use Magenest\Movie\Model\Director as Model;

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
