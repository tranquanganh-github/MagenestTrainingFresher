<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Observer\Customer;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Customer as CustomerModel;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class ChangeFirstName implements ObserverInterface
{
    public const FIRST_NAME = 'Magenest';

    /**
     * @var CustomerFactory
     */
    protected CustomerFactory $customerFactory;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * Constructor
     *
     * @param CustomerFactory $customerFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        CustomerFactory $customerFactory,
        LoggerInterface $logger
    ) {
        $this->customerFactory = $customerFactory;
        $this->logger = $logger;
    }

    /**
     * Execute
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $customerData = $event->getData('customer_data_object');
        $customerId = $customerData->getId();
        if ($customerId) {
            try {
                /** @var CustomerModel $customerModel */
                $customerModel = $this->customerFactory->create();
                $customerModel->load($customerId);
                $customerModel->setData(CustomerInterface::FIRSTNAME, self::FIRST_NAME);
                $customerModel->save();
            } catch (\Exception $e) {
                $this->logger->error(__($e->getMessage()));
            }
        }
    }
}
