<?php

namespace Magenest\Movie\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Movie extends AbstractDb
{
    public const MAIN_TABLE = 'magenest_movie';
    public const FIELD_ID = 'movie_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::FIELD_ID);
    }
}
