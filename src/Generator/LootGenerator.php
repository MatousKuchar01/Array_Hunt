<?php

declare(strict_types=1);

namespace App\Generator;

use App\Enum\Loot;

class LootGenerator
{
    // scaling of chance based on level
    /** @var array<int, array<string, int>> */
    public static array $levelDropChanceMap = [
        1 => ['common' => 80, 'rare' => 20, 'legendary' => 0],
        2 => ['common' => 70, 'rare' => 30, 'legendary' => 0],
        3 => ['common' => 50, 'rare' => 40, 'legendary' => 10],
        4 => ['common' => 30, 'rare' => 40, 'legendary' => 30],
        5 => ['common' => 0, 'rare' => 0, 'legendary' => 100],
    ];

    /**
    * Randomly drops a loot
    * @param int $level chances differ based on level
    * @return string<Loot>
    */
    public static function drop(int $level = 1): Loot
    {
        $lootTable = Loot::rarityTable();
        $selectedPool = self::$levelDropChanceMap[$level];
        $chance = rand(1, 100);

        $selectedRarityRare = $selectedPool['rare'];
        $selectedRarityLegendary = $selectedPool['legendary'];

        $rareThreshold = $selectedRarityLegendary + $selectedRarityRare;

        if ($chance <= $selectedRarityLegendary) {
            $pool = $lootTable['legendary'];
        } elseif ($chance <= $rareThreshold) {
            $pool = $lootTable['rare'];
        } else {
            $pool = $lootTable['common'];
        }

        return $pool[array_rand($pool)];
    }

	/**
     * Gets info about loot
     * @param Loot $loot.
     * @return array<int, array<int, string>>
     */
    public static function getDropInfo(Loot $loot): array
    {
        return [
            ["Symbol", $loot->symbol()],
            ["Name", $loot->label()],
            ["Description", $loot->description()],
            ["Rarity", $loot->rarity()],
        ];
    }
}
