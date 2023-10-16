<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Controller\Adminhtml\Director;

use Exception;
use Magenest\Movie\Model\DirectorFactory as DirectorModelFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class Save extends Action implements HttpPostActionInterface
{
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
        DirectorModelFactory $directorModelFactory,
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
        $data = $this->getRequest()->getPostValue();

        if (!empty($data)) {
            try {
                /** @var $model \Magenest\Movie\Model\Director */
                $model = $this->directorModelFactory->create();
                $model->setDataBeforeSave($data);
                $model->save();
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->logger->critical($e);
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Something went wrong while saving data. Please review the error log.')
                );
                $this->logger->critical($e);
            }
        } else {
            $this->messageManager->addErrorMessage(
                __('Something went wrong while saving.')
            );
        }
        $this->messageManager->addSuccessMessage(__('You saved the new director'));
        $this->_redirect('magenest/index/director');
    }
}
