<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\MovieFactory as MovieModelFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Psr\Log\LoggerInterface;

class Edit extends Action implements HttpGetActionInterface
{
    public const MAIN_MENU_ACTIVE = 'Magenest_Movie::general';
    public const REDIRECT_PATH = 'magenest/index/movie';

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var MovieModelFactory
     */
    protected MovieModelFactory $movieModelFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param LoggerInterface $logger
     * @param MovieModelFactory $movieModelFactory
     */
    public function __construct(
        Context           $context,
        LoggerInterface   $logger,
        MovieModelFactory $movieModelFactory
    ) {
        parent::__construct($context);
        $this->logger = $logger;
        $this->movieModelFactory = $movieModelFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var $model \Magenest\Movie\Model\Movie */
        $model = $this->movieModelFactory->create();
        $id = $this->getRequest()->getParam('movie_id');
        if ($id) {
            $model->load($id);
            if (!$model->getMovieId()) {
                $this->messageManager->addErrorMessage(__('This movie no longer exists.'));

                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath(self::REDIRECT_PATH);

                return $resultRedirect;
            }
        }

        /** @var $resultRedirect Page */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu(self::MAIN_MENU_ACTIVE);
        $resultPage->getConfig()->getTitle()->prepend(
            $model->getMovieId() ? __($model->getMovieName()) : __('Add New Movie')
        );

        return $resultPage;
    }
}
