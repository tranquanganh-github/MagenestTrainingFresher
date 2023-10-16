<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

class SampleDataDirector implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    protected ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface          $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * Get Dependencies
     *
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get Alias
     *
     * @return string[]
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * Get version
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return '1.0.0';
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $setup = $this->moduleDataSetup;
        $setup->startSetup();
        try {
            $directorName = [
                'Francis Ford Coppola',
                'Robert Zemeckis',
                'James Cameron',
                'Frank Darabont',
                'Peter Jackson',
                'Chris Columbus',
                'Christopher Nolan',
                'Lilly Wachowski'
            ];

            $connection = $setup->getConnection();

            if (!empty($directorName)) {
                foreach ($directorName as $name) {
                    $connection->insert(
                        'magenest_director',
                        ['name' => $name]
                    );
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        $setup->endSetup();
    }
}
