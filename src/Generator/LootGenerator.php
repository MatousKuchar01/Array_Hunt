<?php

namespace App\Generator;

use App\Enum\Loot;

class LootGenerator
{
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
}
