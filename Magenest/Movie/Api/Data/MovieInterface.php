<?php

namespace Magenest\Movie\Api\Data;

interface MovieInterface
{
    public const MOVIE_ID = 'movie_id';
    public const MOVIE_NAME = 'name';
    public const MOVIE_DESCRIPTION = 'description';
    public const MOVIE_RATING = 'rating';
    public const MOVIE_DIRECTOR_ID = 'director_id';

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
     * Get Movie Name
     *
     * @return string|null
     */
    public function getMovieName();

    /**
     * Set Movie Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setMovieName(string $name);

    /**
     * Get Movie Description
     *
     * @return string|null
     */
    public function getMovieDescription();

    /**
     * Set Movie Description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setMovieDescription(string $description);

    /**
     * Get Movie Rating
     *
     * @return int|null
     */
    public function getMovieRating();

    /**
     * Set Movie Rating
     *
     * @param int $rating
     *
     * @return $this
     */
    public function setMovieRating(int $rating);

    /**
     * Get Movie Director Id
     *
     * @return int|null
     */
    public function getMovieDirectorId();

    /**
     * Set Movie Director Id
     *
     * @param int $directorId
     *
     * @return $this
     */
    public function setMovieDirectorId(int $directorId);
}
