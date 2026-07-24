<?php

declare(strict_types=1);

namespace App\Service;

use App\Util\Orc;
use App\Util\Knight;
use Symfony\Component\Console\Style\SymfonyStyle;

class DuelService
{
    public function duel(SymfonyStyle $io)
    {
        self::renderAttackCircle($io);
    }

    /**
     * @return void
     */
    private static function renderAttackCircle(SymfonyStyle $io): void
    {
        $circle = <<<ASCII
                       [ TOP ]
                      /       \
               [ LEFT ]   S   [ RIGHT ]
                      \       /
                 [ B_LEFT ] [ B_RIGHT ]
        ASCII;

        $io->writeln($circle);
        $io->newLine();
    }
}
