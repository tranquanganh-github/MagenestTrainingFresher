<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Controller\Adminhtml\Director;

use Magenest\Movie\Model\DirectorFactory as DirectorModelFactory;
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
    public const REDIRECT_PATH = 'magenest/index/director';

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var DirectorModelFactory
     */
    protected DirectorModelFactory $directorModelFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param LoggerInterface $logger
     * @param DirectorModelFactory $directorModelFactory
     */
    public function __construct(
        Context           $context,
        LoggerInterface   $logger,
        DirectorModelFactory $directorModelFactory
    ) {
        parent::__construct($context);
        $this->logger = $logger;
        $this->directorModelFactory = $directorModelFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var $model \Magenest\Movie\Model\Director */
        $model = $this->directorModelFactory->create();
        $id = $this->getRequest()->getParam('director_id');
        if ($id) {
            $model->load($id);
            if (!$model->getDirectorId()) {
                $this->messageManager->addErrorMessage(__('This director no longer exists.'));

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
            $model->getDirectorId() ? __($model->getDirectorName()) : __('Add New Director')
        );

        return $resultPage;
    }
}
