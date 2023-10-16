<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Observer\Config;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeValue implements ObserverInterface
{
    public const XML_PATH_MOVIE_DEMO_TEXT = 'movie/movie_configuration/demo_text';
    private const CONFIG_SECTION = 'movie';
    private const VALID_TEXT = 'PING';
    private const CHANGED_TEXT = 'Pong';

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var WriterInterface
     */
    protected WriterInterface $configWriter;

    /**
     * Constructor
     *
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface  $configWriter
    ) {
        $this->request = $request;
        $this->configWriter = $configWriter;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $paramRequest = $this->request->getParams();
        if ($this->isValid($paramRequest)) {
            $this->configWriter->save(self::XML_PATH_MOVIE_DEMO_TEXT, self::CHANGED_TEXT);
        }
    }

    /**
     * Check config data is valid
     *
     * @param array $param
     *
     * @return bool
     */
    private function isValid(array $param): bool
    {
        if ($param['section'] !== self::CONFIG_SECTION) {
            return false;
        }

        $paramValue = $param['groups']['movie_configuration']['fields']['demo_text']['value'];

        if (empty($paramValue) || strtoupper($paramValue) !== self::VALID_TEXT) {
            return false;
        }

        return true;
    }
}
