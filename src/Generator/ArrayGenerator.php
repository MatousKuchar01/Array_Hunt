<?php

declare(strict_types=1);

namespace App\Generator;

use App\Util\Chest;
use App\Util\Mimic;
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
            $mainKey = self::generateRandomKey();

            do {
                $sideKey = self::generateRandomKey();
            } while ($mainKey === $sideKey);

            if (rand(1, 100) <= 20) {
                $currentArray[$sideKey] = new Mimic();
            } else {
                $currentArray[$sideKey] = "[]";
            }

            $currentArray[$mainKey] = []; // passes to $finalArray
            $currentArray = &$currentArray[$mainKey]; // move the drill further into array
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
   			if (is_object($item) && method_exists($item, '__toString')) {
                $item = (string) $item;
           	}
        });

        dump($displayMaze);
    }

    /**
     * generates a random key
     * @return int|string
     */
    private static function generateRandomKey(): int|string
    {
        return match(rand(1, 3)) {
            1 => 'path_' . rand(1, 10),
            2 => rand(1, 10),
            3 => 'node_' . chr(rand(97, 122)),
        };
    }
}
