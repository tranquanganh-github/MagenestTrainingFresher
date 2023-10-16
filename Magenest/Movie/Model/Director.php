<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Model;

use Magenest\Movie\Api\Data\DirectorInterface;
use Magenest\Movie\Model\ResourceModel\Director as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Director extends AbstractModel implements DirectorInterface
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
    public function getDirectorId()
    {
        return $this->_getData(self::DIRECTOR_ID);
    }

    /**
     * @inheritDoc
     */
    public function setDirectorId(int $id)
    {
        return $this->setData(self::DIRECTOR_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getDirectorName()
    {
        return $this->_getData(self::DIRECTOR_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setDirectorName(string $name)
    {
        return $this->setData(self::DIRECTOR_NAME, $name);
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
            $this->setDirectorName($data[self::DIRECTOR_NAME]);
        }

        return $this;
    }
}
