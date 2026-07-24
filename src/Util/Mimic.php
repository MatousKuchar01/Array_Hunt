<?php

declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Console\Style\SymfonyStyle;

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

    /**
     * @param Knight $knight
     * @return void
     */
    public function attack(Knight $knight): void
    {
        $knight->takeDamage($this->chewingPower);
    }

    /**
     * @param SymfonyStyle $io
     * @param mixed $target
     * @return bool
     */
    public static function isTargetMimic(SymfonyStyle $io, mixed $target, Knight $knight): bool
    {
    	if ($target instanceof self) {
            $target->attack($knight);
    		return true;
    	} else {
    		return false;
    	}
    }
}
