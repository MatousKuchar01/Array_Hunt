<?php

namespace App\Util;

use App\Enum\Loot;

class Chest
{
    public function __construct(private Loot $loot) {}

    public function getChest(): string
    {
        return '[=X=]'; // $loot is hidden in this chest :o
    }

    public function open(): Loot
    {
        return $this->loot;
    }
}
