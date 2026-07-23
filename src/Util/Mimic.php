<?php

declare(strict_types=1);

namespace App\Util;

class Mimic
{
    public int $chewingPower = 1;

    /**
     * @return string
     */
    public function getChest(): string
    {
        return '[=X=]'; // no $loot is hidden in this chest >:o
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getChest();
    }

    public function attack(Knight $knight)
    {
        $knight->takeDamage($this->chewingPower);
    }
}
