<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\AppEnum;
use App\Util\Knight;
use App\Util\Altar;
use App\Util\Fountain;
use Symfony\Component\Console\Style\SymfonyStyle;

class ObjectService
{
    /**
     * handles interaction with altar
     * @param SymfonyStyle $io
     * @param Knight $knight
     * @param Altar $altar
     * @param string|null $lastMessage
     * @return void
     */
    public function altar(SymfonyStyle $io, Knight $knight, Altar $altar, ?string &$lastMessage)
    {
        self::renderAltarAscii($io);

        $answer = $io->confirm('Do you want to sacrifice 1 HP?', false);
        $roll = rand(1, 100);

        if ($answer) {
            $knight->takeDamage(1);

            if (!$knight->isAlive()) {
                return;
            }

            match (true) {
                $roll <= 25 => $altar->buffLoot($knight, $lastMessage), // 25% chance
                $roll <= 50 => $altar->doubleLootGold($knight, $lastMessage), // 25% chance
                $roll <= 75 => $altar->grantKey($knight, $lastMessage), // 25% chance
                default => $lastMessage = AppEnum::ALTAR_NOTHING->value // 25% chance
            };
        } else {
            $lastMessage = AppEnum::ALTAR_QUIT->value;
        }
    }

    /**
     * handles interaction with fountain
     * @param SymfonyStyle $io
     * @param Knight $knight
     * @param Fountain $fountain
     * @param string|null $lastMessage
     * @return void
     */
    public function fountain(SymfonyStyle $io, Knight $knight, Fountain $fountain, ?string &$lastMessage)
    {
        self::renderFountainAscii($io);

        if ($fountain->isUsed()) {
            $lastMessage = AppEnum::FOUNTAIN_USED->value;
            return;
        }

        $answer = $io->confirm('Do you want to drink from the fountain?', false);
        $roll = rand(1, 100);

        if ($answer) {
            $fountain->markAsUsed();

            if ($roll <= 80) {
                $knight->heal(1);
                $lastMessage = AppEnum::FOUNTAIN_HEAL->value;
            } else {
                $knight->takeDamage(1);
                $lastMessage = AppEnum::FOUNTAIN_POISON->value;

                if (!$knight->isAlive()) {
                    return;
                }
            }
        } else {
            $lastMessage = AppEnum::FOUNTAIN_QUIT->value;
        }
    }

    /**
     * renders altar ascii
     * @see https://patorjk.com/software/taag/#p=display&f=Alligator2&t=altar&x=none&v=4&h=4&w=80&we=false
     * @return void
     */
    public static function renderAltarAscii(SymfonyStyle $io): void
    {
        $asciiArt = <<<ASCII
        :::     :::    ::::::::::: :::     :::::::::
      :+: :+:   :+:        :+:   :+: :+:   :+:    :+:
     +:+   +:+  +:+        +:+  +:+   +:+  +:+    +:+
    +#++:++#++: +#+        +#+ +#++:++#++: +#++:++#:
    +#+     +#+ +#+        +#+ +#+     +#+ +#+    +#+
    #+#     #+# #+#        #+# #+#     #+# #+#    #+#
    ###     ### ########## ### ###     ### ###    ###
ASCII;

        $io->writeln($asciiArt);
    }

    /**
     * renders altar ascii
     * @see https://patorjk.com/software/taag/#p=display&f=The+Edge&t=Fountain&x=none&v=4&h=4&w=80&we=false
     * @return void
     */
    public static function renderFountainAscii(SymfonyStyle $io): void
    {
        $asciiArt = <<<ASCII
        ▄████  ████▄   ▄      ▄     ▄▄▄▄▀ ██   ▄█    ▄
        █▀   ▀ █   █    █      █ ▀▀▀ █    █ █  ██     █
        █▀▀    █   █ █   █ ██   █    █    █▄▄█ ██ ██   █
        █      ▀████ █   █ █ █  █   █     █  █ ▐█ █ █  █
         █           █▄ ▄█ █  █ █  ▀         █  ▐ █  █ █
          ▀           ▀▀▀  █   ██           █     █   ██
                                           ▀
    ASCII;

        $io->writeln($asciiArt);
    }
}
