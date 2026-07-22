<?php

declare(strict_types=1);

namespace App\Generator;

use App\Enum\Loot;

class LootGenerator
{
    /**
    * Randomly drops a loot
    * @return string<Loot>
    */
    public static function drop(): Loot
    {
        $lootTable = Loot::rarityTable();
        $chance = rand(1, 100);

        if ($chance <= 5) {
            $pool = $lootTable['legendary'];
        } else if ($chance <= 20) {
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
        ];
    }
}
