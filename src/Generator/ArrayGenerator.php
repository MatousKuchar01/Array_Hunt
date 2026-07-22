<?php

declare(strict_types=1);

namespace App\Generator;

use App\Util\Chest;
use App\Enum\Loot;
use App\Generator\LootGenerator;

class ArrayGenerator
{
    /**
     * @return array<string|int, mixed>
     */
    public static function generateFirstLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 3);
    }

    /**
     * @return array<string|int, mixed>
     */
    public static function generateSecondLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 4);
    }

    /**
     * @return array<string|int, mixed>
     */
    public static function generateThirdLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 5);
    }

    /**
    * Builds random array + loot with various depth
    * @param Loot $loot
    * @param int $depth
    * @return array<string|int, mixed>
    */
    private static function buildArray(Loot $loot, int $depth = 0): array
    {
        $finalArray = [];
        $currentArray = &$finalArray;

        for ($i = 0; $i < $depth; $i++) {
            $randomKey = match(rand(1, 3)) {
                1 => 'path_' . rand(1, 10),
                2 => rand(1, 10),
                3 => 'node_' . chr(rand(97, 122)),
            };

            $currentArray[$randomKey] = []; // passes to $finalArray
            $currentArray = &$currentArray[$randomKey]; // move the drill further into array
        }

        $currentArray = new Chest($loot); // hide loot at the end of array

        return $finalArray;
    }

    /**
     * @param array<string|int, mixed> $level
     * @return void
     */
    public static function dumpLevel(array $level): void
    {
        $displayMaze = $level;

      	array_walk_recursive($displayMaze, function (&$item) {
   			if ($item instanceof \App\Util\Chest) {
                $item = (string) $item;
           	}
        });

        dump($displayMaze);
    }
}
