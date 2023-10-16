<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magenest\Movie\Model\ActorFactory as ActorModelFactory;
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
    public const REDIRECT_PATH = 'magenest/index/actor';

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var ActorModelFactory
     */
    protected ActorModelFactory $actorModelFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param LoggerInterface $logger
     * @param ActorModelFactory $actorModelFactory
     */
    public function __construct(
        Context           $context,
        LoggerInterface   $logger,
        ActorModelFactory $actorModelFactory
    ) {
        parent::__construct($context);
        $this->logger = $logger;
        $this->actorModelFactory = $actorModelFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var $model \Magenest\Movie\Model\Actor */
        $model = $this->actorModelFactory->create();
        $id = $this->getRequest()->getParam('actor_id');
        if ($id) {
            $model->load($id);
            if (!$model->getActorId()) {
                $this->messageManager->addErrorMessage(__('This actor no longer exists.'));

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
            $model->getActorId() ? __($model->getActorName()) : __('Add New Actor')
        );

        return $resultPage;
    }
}
