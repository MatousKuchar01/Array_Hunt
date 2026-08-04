<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\AppEnum;
use App\Util\Knight;
use App\Util\Altar;
use Symfony\Component\Console\Style\SymfonyStyle;

class ObjectService
{
    /**
     * handles interaction with altar
     * @param SymfonyStyle $io
     * @param Knight $knight
     * @param Altar $altar
     * @param string|null $lastMessage
     * @return todo
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
                $roll <= 40 => $altar->buffLoot($knight, $lastMessage), // 40% chance (1–40)
                // $roll <= 60 => $altar->doubleLootGold(),
                $roll <= 70 => $altar->grantKey($knight, $lastMessage), // 30% chance (41-70)
                default => $lastMessage = AppEnum::ALTAR_NOTHING->value // 30% chance (71–100)
            };
        } else {
            $lastMessage = AppEnum::ALTAR_QUIT->value;
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
}
