<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

class SampleDataMovie implements DataPatchInterface
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
            $movieName = [
                'The Godfather',
                'Forrest Gump',
                'Titanic',
                'The Shawshank Redemption',
                'The Lord of the Rings',
                'Harry Potter',
                'Inception',
                'Matrix'
            ];

            $description = [
                "Don Vito Corleone, head of a mafia family, decides to hand over his empire to his youngest son Michael. However, his decision unintentionally puts the lives of his loved ones in grave danger.",
                "The history of the United States from the 1950s to the '70s unfolds from the perspective of an Alabama man with an IQ of 75, who yearns to be reunited with his childhood sweetheart.",
                "A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.",
                "Over the course of several years, two convicts form a friendship, seeking consolation and, eventually, redemption through basic compassion.",
                "Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.",
                "An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.",
                "A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.",
                "When a beautiful stranger leads computer hacker Neo to a forbidding underworld, he discovers the shocking truth--the life he knows is the elaborate deception of an evil cyber-intelligence."
            ];

            $rating = [92, 88, 89, 95, 95, 95, 91, 99];

            $directorId = [1, 2, 3, 4, 5, 6, 7, 8];

            if (!empty($movieName) && !empty($description) && !empty($rating) && !empty($directorId)) {
                $data = [];
                for ($i = 0; $i < count($movieName); $i++) {
                    $data[$i] = [
                        'name' => $movieName[$i],
                        'description' => $description[$i],
                        'rating' => $rating[$i],
                        'director_id' => $directorId[$i]
                    ];
                }

                $setup->getConnection()->insertArray(
                    $setup->getTable('magenest_movie'),
                    ['name', 'description', 'rating', 'director_id'],
                    $data
                );
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        $setup->endSetup();
    }
}
