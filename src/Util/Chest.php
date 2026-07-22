<?php

declare(strict_types=1);

namespace App\Util;

use App\Enum\Loot;
use App\Generator\LootGenerator;

class Chest
{
    public function __construct(private Loot $loot) {}

    /**
     * @return string
     */
    public function getChest(): string
    {
        return '[=X=]'; // $loot is hidden in this chest :o
    }

    /**
     * @return Loot
     */
    public function open(): Loot
    {
        return $this->loot;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getChest();
    }

    /**
     * @param SymfonyStyle $io
     * @param mixed $target
     * @return bool
     */
    public static function isTargetChest($io, $target): bool
    {
    	if ($target instanceof self) {
    		$loot = $target->open();
    		$infoRows = LootGenerator::getDropInfo($loot);

            $io->table(
                ['Property', 'Value'],
                $infoRows
            );

    		return true;
    	} else {
    		$io->error(AppEnum::WRONG_TARGET->value);
    		return false;
    	}
    }
}
