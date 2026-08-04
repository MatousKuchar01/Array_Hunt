<?php

declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Console\Style\SymfonyStyle;
use App\Enum\Loot;

class Knight
{
    /** @var int */
    public int $hp = 3; // <3 <3 <3
    /** @var boolean */
    public bool $hasKey = false; // for opening the chest
    /** @var array<Loot> */
    public array $inventory = []; // all collected loot

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
     * @return bool
     */
    public function hasKey(): bool
    {
        return $this->hasKey === true;
    }

    /**
     * @return void
     */
    public function obtainKey(): void
    {
        $this->hasKey = true;
    }

    /**
     * @return void
     */
    public function useKey(): void
    {
        $this->hasKey = false;
    }

    /**
     * adds Loot object to inventory
     * @param Loot $loot
     * @param int $level
     * @return void
     */
    public function addLootToInventory(Loot $loot, int $level = 1): void
    {
        $this->inventory[] = $loot;
    }

    /**
     * @return array<Loot>
     */
    public function getInventory(): array
    {
        return $this->inventory;
    }

    /**
     * @param int $hp
     * @return string
     */
    public static function convertHPToHearts(int $hp): string
    {
        return match ($hp) {
            3 => "<3 <3 <3",
            2 => "<3 <3",
            1 => "<3",
            default => "",
        };
    }

    /**
     * ascii art of knight body
     * @see https://www.asciiart.eu/art/c2e8a00886ab6627
     * @see https://www.asciiart.eu/people/occupations/knights
     * @return void
     */
    public static function ascii(SymfonyStyle $io): void
    {
        $asciiArt = <<<ASCII
            !
           .-.
         __|=|__
        (_/`-`\_)
        //\___/\\
        <>/   \<>
         \|_._|/
          <_I_>
           |||
          /_|_\
        ASCII;

        $io->writeln($asciiArt);
    }
}
