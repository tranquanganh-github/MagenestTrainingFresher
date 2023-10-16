<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Model;

use Magenest\Movie\Api\Data\ActorInterface;
use Magenest\Movie\Model\ResourceModel\Actor as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Actor extends AbstractModel implements ActorInterface
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

    /**
     * @inheritDoc
     */
    public function getActorName()
    {
        return $this->_getData(self::ACTOR_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setActorName(string $name)
    {
        return $this->setData(self::ACTOR_NAME, $name);
    }

    /**
     * Prepare data before save
     *
     * @param array $data
     *
     * @return $this
     */
    public function setDataBeforeSave(array $data)
    {
        if (!empty($data)) {
            $this->setActorName($data[self::ACTOR_NAME]);
        }

        return $this;
    }
}
