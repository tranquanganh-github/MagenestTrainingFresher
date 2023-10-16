<?php

namespace Magenest\Movie\Api\Data;

interface ActorInterface
{
    public const ACTOR_ID = 'actor_id';
    public const ACTOR_NAME = 'name';

    /**
     * Get Actor id
     *
     * @return int|null
     */
    public function getActorId();

    /**
     * Set Actor id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setActorId(int $id);

    /**
     * Get Actor Name
     *
     * @return string|null
     */
    public function getActorName();

    /**
     * Set Actor Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setActorName(string $name);
}
