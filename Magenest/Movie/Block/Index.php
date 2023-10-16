<?php

namespace Magenest\Movie\Block;

use Magenest\Movie\Api\Data\MovieActorInterface;
use Magenest\Movie\Model\ActorFactory as ActorModelFactory;
use Magenest\Movie\Model\Director;
use Magenest\Movie\Model\DirectorFactory as DirectorModelFactory;
use Magenest\Movie\Model\ResourceModel\Movie\Collection;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as MovieCollectionFactory;
use Magenest\Movie\Model\ResourceModel\MovieActor\CollectionFactory as MovieActorCollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    /**
     * @var MovieCollectionFactory
     */
    public MovieCollectionFactory $movieCollectionFactory;

    /**
     * @var DirectorModelFactory
     */
    public DirectorModelFactory $directorModelFactory;

    /**
     * @var MovieActorCollectionFactory
     */
    public MovieActorCollectionFactory $movieActorCollectionFactory;

    /**
     * @var ActorModelFactory
     */
    public ActorModelFactory $actorModelFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param MovieCollectionFactory $movieCollectionFactory
     * @param MovieActorCollectionFactory $movieActorCollectionFactory
     * @param DirectorModelFactory $directorModelFactory
     * @param ActorModelFactory $actorModelFactory
     * @param array $data
     */
    public function __construct(
        Template\Context            $context,
        MovieCollectionFactory      $movieCollectionFactory,
        MovieActorCollectionFactory $movieActorCollectionFactory,
        DirectorModelFactory        $directorModelFactory,
        ActorModelFactory           $actorModelFactory,
        array                       $data = []
    ) {
        parent::__construct($context, $data);
        $this->movieCollectionFactory = $movieCollectionFactory;
        $this->directorModelFactory = $directorModelFactory;
        $this->movieActorCollectionFactory = $movieActorCollectionFactory;
        $this->actorModelFactory = $actorModelFactory;
    }

    /**
     * Get Movies
     *
     * @return array|null
     */
    public function getMovies()
    {
        /** @var $movie Collection */
        $movie = $this->movieCollectionFactory->create();
        return $movie->getData();
    }

    /**
     * Get Director name by id
     *
     * @param int $id
     *
     * @return mixed|string|null
     */
    public function getDirectorById(int $id)
    {
        if ($id) {
            /** @var $director Director */
            $director = $this->directorModelFactory->create();
            if ($director->load($id)) {
                return $director->getDirectorName();
            }
        }
        return null;
    }

    /**
     * Get Actor name in movie by id
     *
     * @param int $id
     *
     * @return array
     */
    public function getActorByMovieId(int $id)
    {
        $actors = [];
        if ($id) {
            /** @var $collection \Magenest\Movie\Model\ResourceModel\MovieActor\Collection */
            $collection = $this->movieActorCollectionFactory->create();
            $collection->addFieldToFilter(MovieActorInterface::MOVIE_ID, ['eq' => $id]);
            if ($collection->getData()) {
                $actor = $this->actorModelFactory->create();
                /** @var $actor \Magenest\Movie\Model\Actor */
                foreach ($collection->getData() as $item) {
                    if ($actor->load($item[MovieActorInterface::ACTOR_ID])) {
                        $actors[] = $actor->getActorName();
                    }
                }
            }
        }

        return $actors;
    }
}
