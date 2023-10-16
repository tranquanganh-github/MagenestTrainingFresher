<?php

namespace Magenest\Movie\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Director extends AbstractDb
{
    public const MAIN_TABLE = 'magenest_director';
    public const FIELD_ID = 'director_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::FIELD_ID);
    }
}
