<?php

namespace App\Generator;

class ArrayGeneratorV1
{
    public static function generateLevel1()
    {
        return self::buildArray();
    }

    public static function generateLevel2()
    {
        return self::buildArray();
    }

    public static function generateLevel3()
    {
        return self::buildArray();
    }

    /**
    * Builds random array + loot with various depth
    * @param Loot $loot
    * @param int $depth
    * @return array
    */
    private static function buildArray(Loot $loot, int $depth = 0): array
    {
        $finalArray = [];
        $currentArray = &$finalArray[];

        for ($i = 0; $i < $depth; $i++) {
            $randomKey = match(rand(1, 3)) {
                1 => 'path_' . rand(1, 10),
                2 => rand(1, 10),
                3 => 'node_' . chr(rand(97, 122)),
            };

            $currentArray[$randomKey] = []; // passes to $finalArray
            $currentArray = &$currentArray[$randomKey]; // move the drill further into array
        }

        $currentArray = $loot; // hide loot at the end of array

        return $finalArray;
    }
}
