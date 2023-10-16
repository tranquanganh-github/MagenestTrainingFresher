<?php

namespace Magenest\Movie\Model;

use Magenest\Movie\Api\Data\MovieActorInterface;
use Magento\Framework\Model\AbstractModel;
use Magenest\Movie\Model\ResourceModel\MovieActor as ResourceModel;

class MovieActor extends AbstractModel implements MovieActorInterface
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getMovieId()
    {
        return $this->_getData(self::MOVIE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setMovieId(int $id)
    {
        return $this->setData(self::MOVIE_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getActorId()
    {
        return $this->_getData(self::ACTOR_ID);
    }

    /**
     * @inheritDoc
     */
    public function setActorId(int $id)
    {
        return $this->setData(self::ACTOR_ID, $id);
    }
}
