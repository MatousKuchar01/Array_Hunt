<?php

namespace App\Enums;

enum Loot
{
    // COMMON
    case COLD_COFFEE;
    case NOTHING;
    case FUNNY_GUY;
    case CONFUSED_GUY;
    case SLEEPING_GUY;
    case KITTY;
    case KITTY_2;
    case BUG;
    case ACTUAL_NULL;

    // RARE
    case LONGSWORD;
    case POINTER;
    case INFINITE_LOOP;
    case CODING_HAT;
    case MEMORY_LEAK;
    case BIGGER_BUG;

    // LEGENDARY
    case RAGING_GUY;
    case WIZARD;
    case DUCKY_DUCK;
    case HAPPY_GUY;
    case HUGE_CAT;

    public function symbol(): string
    {
        return match ($this) {
            // COMMON
            self::COLD_COFFEE => 'Cold coffee',
            self::NOTHING => 'Nothing',
            self::FUNNY_GUY => 'Funny guy',
            self::CONFUSED_GUY => 'Confused guy',
            self::SLEEPING_GUY => 'Sleeping guy',
            self::KITTY => 'Kitty',
            self::KITTY_2 => 'Kitty 2',
            self::BUG => 'Bug',
            self::ACTUAL_NULL => 'Actual NULL',
            // RARE
            self::LONGSWORD => 'Longsword',
            self::POINTER => 'Pointer',
            self::INFINITE_LOOP => 'Infinite loop',
            self::CODING_HAT => 'Coding hat',
            self::MEMORY_LEAK => 'Memory leak',
            self::BIGGER_BUG => 'Bigger bug',
            // LEGENDARY
            self::RAGING_GUY => 'Raging guy',
            self::WIZARD => 'Wizard',
            self::DUCKY_DUCK => 'Ducky duck',
            self::HAPPY_GUY => 'Happy guy',
            self::HUGE_CAT => 'Huge cat',
        };
    }
}
