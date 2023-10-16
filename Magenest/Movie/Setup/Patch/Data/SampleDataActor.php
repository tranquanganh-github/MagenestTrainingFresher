<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

class SampleDataActor implements DataPatchInterface
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
            $actorName = [
                'Keanu Reeves',
                'Carrie-Anne Moss',
                'Laurence Fishburne',
                'Marlon Brando',
                'Al Pacino',
                'James Caan',
                'Richard S. Castellano',
                'Tom Hanks',
                'Sally Field',
                'Leonardo DiCaprio',
                'Kate Winslet',
                'Tim Robbins',
                'Morgan Freeman',
                'Andy Serkis',
                'Ian Holm',
                'Daniel Radcliffe',
                'Rupert Grint',
                'Emma Watson',
                'Joseph Gordon-Levitt',
                'Ken Watanabe'
            ];

            $connection = $setup->getConnection();

            if (!empty($actorName)) {
                foreach ($actorName as $name) {
                    $connection->insert(
                        'magenest_actor',
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
