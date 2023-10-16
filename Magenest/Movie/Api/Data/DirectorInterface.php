<?php

namespace Magenest\Movie\Api\Data;

interface DirectorInterface
{
    public const DIRECTOR_ID = 'director_id';
    public const DIRECTOR_NAME = 'name';

    /**
     * Get Director id
     *
     * @return int|null
     */
    public function getDirectorId();

    /**
     * Set Director id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setDirectorId(int $id);

    /**
     * Get Director Name
     *
     * @return string|null
     */
    public function getDirectorName();

    /**
     * Set Director Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setDirectorName(string $name);
}
