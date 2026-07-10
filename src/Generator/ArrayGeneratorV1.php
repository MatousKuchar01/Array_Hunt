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
    * Builds random array with loot with various depth
    * @param Loot $loot
    * @param int $depth
    * @return array
    */
    private static function buildArray(Loot $loot, int $depth = 0): array
    {
        //todo
    }
}
