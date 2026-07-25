<?php

declare(strict_types=1);

namespace App\Util;

use App\Enum\AppEnum;
use App\Enum\Loot;
use App\Generator\LootGenerator;
use Symfony\Component\Console\Style\SymfonyStyle;

class Chest
{
    /** @var boolean */
    public bool $isLocked; // orc has the key

    public function __construct(private Loot $loot, bool $isLocked)
    {
        $this->isLocked = $isLocked;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->isLocked === true;
    }

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
     * @param Knight $knight
     * @param string|null $lastMessage
     * @return bool
     */
    public static function isTargetChest($io, $target, Knight $knight, ?string &$lastMessage): bool
    {
    	if ($target instanceof self) {
            // chest is locked and knight doesnt have a key
            if ($target->isLocked() && !$knight->hasKey()) {
                $lastMessage = AppEnum::CHEST_MISSING_KEY->value;
                return false;
            }

            // chest is locked and knight does have the key
            if ($target->isLocked() && $knight->hasKey()) {
                $knight->useKey();
                $io->note(AppEnum::CHEST_KEY_USED->value);
            }

    		$loot = $target->open();
    		$infoRows = LootGenerator::getDropInfo($loot);

            $io->table(
                ['Property', 'Value'],
                $infoRows
            );

    		return true;
    	} else {
    		return false;
    	}
    }
}
