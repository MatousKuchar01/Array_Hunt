<?php

declare(strict_types=1);

namespace App\Util;

class Knight
{
    public int $hp = 3; // <3 <3 <3

    /** @return int */
    public function getHP(): int
    {
        return $this->hp;
    }

    /** @return bool */
    public function isAlive(): bool
    {
        return $this->hp > 0;
    }

    /**
     * @param int $amount
     * @return void
     */
    public function takeDamage(int $amount): void
    {
        $this->hp -= $amount;
    }

    /**
     * @param int $hp
     * @return string
     */
    public static function convertHPToHearts(int $hp): string
    {
        match ($hp) {
            3 => '<3 <3 <3',
            2 => '<3 <3',
            1 => '<3',
            default => ''
        };
    }
}
