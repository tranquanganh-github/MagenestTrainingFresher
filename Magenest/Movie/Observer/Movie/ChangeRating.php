<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Observer\Movie;

use Magenest\Movie\Model\MovieFactory as MovieModelFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class ChangeRating implements ObserverInterface
{
    public const MOVIE_RATING = 0;

    /**
     * @var MovieModelFactory
     */
    protected MovieModelFactory $movieFactory;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * Constructor
     *
     * @param MovieModelFactory $movieFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        MovieModelFactory $movieFactory,
        LoggerInterface   $logger
    ) {
        $this->movieFactory = $movieFactory;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $movieData = $event->getData('data_object');
        $movieId = $movieData->getMovieId();
        try {
            if ($movieId) {
                /** @var $movieModel \Magenest\Movie\Model\Movie */
                $movieModel = $this->movieFactory->create();
                $movieModel->load($movieId);
                $movieModel->setMovieRating(self::MOVIE_RATING);
                $movieModel->save();
            }
        } catch (\Exception $e) {
            $this->logger->error(__($e->getMessage()));
        }
    }
}
