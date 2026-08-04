<?php

declare(strict_types=1);

namespace App\Util;

use App\Enum\AppEnum;
use App\Enum\Loot;
use App\Util\Knight;
use App\Generator\LootGenerator;
use Symfony\Component\Console\Style\SymfonyStyle;

class Altar
{
    public function __construct() {}

    /**
     * @return string
     */
    public function getAltar(): string
    {
        return '<<ALTAR>>'; // hmm, what is it?
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getAltar();
    }

    /**
     * @param Knight $knight
     * @param string|null $lastMessage
     * @return void
     */
    public function grantKey(Knight $knight, ?string &$lastMessage): void
    {
        $knight->obtainKey();
        $lastMessage = AppEnum::ALTAR_GRANTED_KEY->value;
    }

    /**
     * @param Knight $knight
     * @param string|null $lastMessage
     * @return void
     */
    public function buffLoot(Knight $knight, ?string &$lastMessage): void
    {
        $knight->hasLootBuff = true;
        $lastMessage = AppEnum::ALTAR_BUFF_LOOT->value;
    }

    /**
     * @param mixed $target
     * @return bool
     */
    public static function isTargetAltar(mixed $target): bool
    {
    	if ($target instanceof self) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
