<?php

namespace App\Enum;

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

    /**
     * Returns item label
     * @return string
     */
    public function label(): string
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

    /**
     * Returns item symbol
     * @return string
     */
    public function symbol(): string
    {
        return match ($this) {
            // COMMON
            self::COLD_COFFEE => 'c[_]',
            self::NOTHING => '¯\_(ツ)_/¯',
            self::FUNNY_GUY => '( ._.)',
            self::CONFUSED_GUY => '＼(〇_ｏ)／',
            self::SLEEPING_GUY => '(-.-)',
            self::KITTY => '(=^..^=)',
            self::KITTY_2 => '(^._.^)~',
            self::BUG => '/v\\',
            self::ACTUAL_NULL => '[NULL]',
            // RARE
            self::LONGSWORD => 'o()xxxx||======>',
            self::POINTER => '(☞ﾟ∀ﾟ)☞',
            self::INFINITE_LOOP => '∞',
            self::CODING_HAT => '_/\_',
            self::MEMORY_LEAK => '<ooo>',
            self::BIGGER_BUG => '/X\\',
            // LEGENDARY
            self::RAGING_GUY => '(╯°□ °)╯︵ ┻━┻',
            self::WIZARD => '( ͡° ͜ʖ ͡°)⊃━☆ﾟ.*',
            self::DUCKY_DUCK => '（・⊝・）',
            self::HAPPY_GUY => '┗(彡▽彡)┛',
            self::HUGE_CAT => '(=^ ◡ ^=)',
        };
    }

    /**
     * Returns item description
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            // COMMON
            self::COLD_COFFEE => 'You can have it if you want.',
            self::NOTHING => 'There was supposed to be treasure, but developer overslept.',
            self::FUNNY_GUY => 'He just looks at you.',
            self::CONFUSED_GUY => '???',
            self::SLEEPING_GUY => 'Shhhh. quiet.',
            self::KITTY => 'Meeeow.',
            self::KITTY_2 => 'Meooow.',
            self::BUG => 'Scary stuff.',
            self::ACTUAL_NULL => 'Congrats! You found nothing...',
            // RARE
            self::LONGSWORD => 'It doesnt fit in your backpack, but looks cool.',
            self::POINTER => 'This is how pointers in C really look like.',
            self::INFINITE_LOOP => 'It goes on and on and on and on...',
            self::CODING_HAT => 'Boosts your coding poweeer.',
            self::MEMORY_LEAK => '',
            self::BIGGER_BUG => 'Very scary stuff.',
            // LEGENDARY
            self::RAGING_GUY => 'He is mad!',
            self::WIZARD => 'He loves casting spells.',
            self::DUCKY_DUCK => 'Quack quack quack....',
            self::HAPPY_GUY => 'He is having a great time!',
            self::HUGE_CAT => 'The king of all cats.',
        };
    }

    /**
     * Returns item rarity
     * @return string
     */
    public function rarity(): string
    {
        return match ($this) {
            // COMMON
            self::COLD_COFFEE => '<>',
            self::NOTHING => '<>',
            self::FUNNY_GUY => '<>',
            self::CONFUSED_GUY => '<>',
            self::SLEEPING_GUY => '<>',
            self::KITTY => '<>',
            self::KITTY_2 => '<>',
            self::BUG => '<>',
            self::ACTUAL_NULL => '<>',
            // RARE
            self::LONGSWORD => '<> <>',
            self::POINTER => '<> <>',
            self::INFINITE_LOOP => '<> <>',
            self::CODING_HAT => '<> <>',
            self::MEMORY_LEAK => '<> <>',
            self::BIGGER_BUG => '<> <>',
            // LEGENDARY
            self::RAGING_GUY => '<> <> <>',
            self::WIZARD => '<> <> <>',
            self::DUCKY_DUCK => '<> <> <>',
            self::HAPPY_GUY => '<> <> <>',
            self::HUGE_CAT => '<> <> <>',
        };
    }

    /**
     * Returns items by rarity
     * @return array<string, string[]>
     */
    public static function rarityTable(): array
    {
        return [
            'common' => [
                self::COLD_COFFEE,self::NOTHING,self::FUNNY_GUY,
                self::CONFUSED_GUY,self::SLEEPING_GUY,self::KITTY,
                self::KITTY_2,self::BUG,self::ACTUAL_NULL,
            ],
            'rare' => [
                self::LONGSWORD, self::POINTER, self::INFINITE_LOOP,
                self::CODING_HAT, self::MEMORY_LEAK, self::BIGGER_BUG,
            ],
            'legendary' => [
                self::RAGING_GUY, self::WIZARD, self::DUCKY_DUCK,
                self::HAPPY_GUY, self::HUGE_CAT,
            ],
        ];
    }
}
