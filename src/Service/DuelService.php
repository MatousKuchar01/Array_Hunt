<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\AppEnum;
use App\Util\Orc;
use App\Util\Knight;
use Symfony\Component\Console\Style\SymfonyStyle;

class DuelService
{
    public function duel(SymfonyStyle $io, Knight $knight, Orc $orc)
    {
        $duelOver = false;

        while (!$duelOver) {
            self::renderAttackCircle($io);

            $userInput = $io->ask(AppEnum::DUEL_CHOOSE_ATTACK_DIRECTION->value);
            $cleanInput = trim(strtoupper($userInput));

            $knightAttackedHitbox = self::normalizeHitboxInput($cleanInput);

            if (!$orc->isHitboxBlocked($knightAttackedHitbox)) {
                if ($orc->hasKey()) {
                    $knight->obtainKey();
                    $io->success(AppEnum::DUEL_WIN_PLUS_KEY->value);
                } else {
                    $io->success(AppEnum::DUEL_WIN->value);
                }

                $duelOver = true;
            } else {
                $io->warning("Blocked! Orc raised shield against {$knightAttackedHitbox}! Try different direction!");
            }
        }
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

    /**
     * user can type multiple versions of hitbox name
     * @param mixed $cleanInput
     * @return string
     */
    private static function normalizeHitboxInput($cleanInput): string
    {
        return match ($cleanInput) {
            'T', 'TOP' => Orc::HITBOX_TOP,
            'L', 'LEFT' => Orc::HITBOX_LEFT,
            'R', 'RIGHT' => Orc::HITBOX_RIGHT,
            'BL', 'B_LEFT', 'BLEFT' => Orc::HITBOX_B_LEFT,
            'BR', 'B_RIGHT', 'BRIGHT' => Orc::HITBOX_B_RIGHT,
            'S', 'STAB' => Orc::HITBOX_STAB,
            default => $cleanInput
        };
    }
}
