<?php

namespace Magenest\Movie\Api\Data;

interface MovieActorInterface
{
    public const MOVIE_ID = 'movie_id';
    public const ACTOR_ID = 'actor_id';

    /**
     * Get Movie id
     *
     * @return int|null
     */
    public function getMovieId();

    /**
     * Set Movie id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setMovieId(int $id);

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
}
