<?php

declare(strict_types=1);

namespace App\Generator;

use App\Enum\Map;
use App\Util\Chest;
use App\Util\Mimic;
use App\Enum\Loot;
use App\Generator\LootGenerator;
use App\Util\Orc;

class ArrayGenerator
{
    /**
     * @return array<string|int, mixed>
     */
    public static function generateFirstLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 1);
    }

    /**
     * @return array<string|int, mixed>
     */
    public static function generateSecondLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 2);
    }

    /**
     * @return array<string|int, mixed>
     */
    public static function generateThirdLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 3);
    }

    /**
     * @return array<string|int, mixed>
     */
    public static function generateFourthLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 3, isLocked: true);
    }

    /**
     * @return array<string|int, mixed>
     */
    public static function generateFifthLevel(): array
    {
        return self::buildArray(LootGenerator::drop(), depth: 4, isLocked: true);
    }

    /**
    * Builds random array + loot with various depth
    * @param Loot $loot
    * @param int $depth
    * @param bool $isLocked
    * @return array<string|int, mixed>
    */
    private static function buildArray(Loot $loot, int $depth = 0, bool $isLocked = false): array
    {
        $finalArray = [];
        $currentArray = &$finalArray;

        $keySpawnDepth = $isLocked ? rand(0, $depth - 1) : - 1;

        for ($i = 0; $i < $depth; $i++) {
            $mainKey = self::generateRandomKey();

            do {
                $sideKey = self::generateRandomKey();
            } while ($mainKey === $sideKey);

            if ($i === $keySpawnDepth) {
                $currentArray[$sideKey] = new Orc(hasKey: true);
            } else {
                $roll = rand(1, 100);

                if ($roll <= 20) {
                    $currentArray[$sideKey] = new Mimic();
                } elseif ($isLocked && $roll <= 40) {
                    $currentArray[$sideKey] = new Orc(hasKey: false);
                } else {
                    $currentArray[$sideKey] = "[]";
                }
            }

            $currentArray[$mainKey] = []; // passes to $finalArray
            $currentArray = &$currentArray[$mainKey]; // move the drill further into array
        }

        $currentArray = new Chest($loot, isLocked: $isLocked); // hide loot at the end of array

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
     * Custom tree dumper for dungeon array with colors and ASCII structure.
     *
     * @param array<string|int, mixed> $level
     * @param string $prefix Used internally for recursive indentation formatting
     * @return void
     */
    public static function dumpLevelTree(array $level, string $prefix = ''): void
    {
        $keys = array_keys($level);
        $totalKeys = count($keys);

        foreach ($keys as $index => $key) {
            $value = $level[$key];
            $isLast = ($index === $totalKeys - 1);
            $marker = $isLast ? '└── ' : '├── ';

            if (is_array($value)) {
                echo $prefix . $marker . "\033[36m" . $key . "\033[0m" . PHP_EOL;

                $newPrefix = $prefix . ($isLast ? '    ' : '│   ');
                self::dumpLevelTree($value, $newPrefix);
            } else {
                $formattedValue = self::formatTargetValue($value);
                echo $prefix . $marker . "\033[90m" . $key . ":\033[0m " . $formattedValue . PHP_EOL;
            }
        }
    }

    /**
     * Helper to apply ANSI colors based on entity type.
     * @param mixed $value
     * @return string
     */
    private static function formatTargetValue(mixed $value): string
    {
        $stringValue = (string) $value;

        return match (true) {
            $value instanceof Chest => "\033[1;33m" . $stringValue . "\033[0m", // Yellow
            $value instanceof Orc => "\033[1;31m" . $stringValue . "\033[0m", // Bold Red
            $value instanceof Mimic => "\033[0;31m" . $stringValue . "\033[0m", // Red
            //$value instanceof Altar => "\033[1;35m" . $stringValue . "\033[0m", // Bold purple
            //$value instanceof Fountain => "\033[1;36m" . $stringValue . "\033[0m", // Light blue
            default => "\033[90m" . $stringValue . "\033[0m", // Grey for basic "[]"
        };
    }

    /**
     * generates a random key
     * @return string
     */
    private static function generateRandomKey(): string
    {
        $prefixes = Map::getAllVariants();
        $locations = Map::getAllTypes();

        $prefix = $prefixes[array_rand($prefixes)];
        $location = $locations[array_rand($locations)];

        return $prefix . '_' . $location;
    }
}
