<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

class SampleDataMovieActor implements DataPatchInterface
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
            $data = [
                [1, 4],
                [1, 5],
                [1, 6],
                [2, 8],
                [2, 9],
                [3, 10],
                [3, 11],
                [4, 12],
                [4, 13],
                [5, 14],
                [5, 15],
                [6, 16],
                [6, 17],
                [6, 18],
                [7, 10],
                [7, 19],
                [7, 20],
                [8, 1],
                [8, 2],
                [8, 3]
            ];

            if (!empty($data)) {
                $connection = $setup->getConnection();

                foreach ($data as $item) {
                    $connection->insert(
                        'magenest_movie_actor',
                        ['movie_id' => $item[0], 'actor_id' => $item[1]]
                    );
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        $setup->endSetup();
    }
}
