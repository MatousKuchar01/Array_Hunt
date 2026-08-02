<?php

declare(strict_types=1);

namespace App;

use App\Enum\AppEnum;
use App\Generator\ArrayGenerator;
use App\Validator\PathValidator;
use App\Util\Chest;
use App\Util\Mimic;
use App\Util\Knight;
use App\Util\Orc;
use App\Service\RenderService;
use App\Service\DuelService;
use Symfony\Component\Console\Style\SymfonyStyle;

class Engine
{
    /** @var array<int, callable(): array<string|int, mixed>> */
	protected static array $levels = [];

	public function __construct(
	    private RenderService $renderService,
		private DuelService $duelService
	) {}

	/**
	 * main game loop
	 * @param SymfonyStyle $io
     * @return void
	 */
	public function play(SymfonyStyle $io): void
	{
		$this->renderService->renderIntro($io);
		$dumpChoice = $this->renderService->renderDumpChoice($io);

		self::$levels = [
            1 => fn() => ArrayGenerator::generateFirstLevel(),
            2 => fn() => ArrayGenerator::generateSecondLevel(),
            3 => fn() => ArrayGenerator::generateThirdLevel(),
            4 => fn() => ArrayGenerator::generateFourthLevel(),
            5 => fn() => ArrayGenerator::generateFifthLevel(),
		];

		$knight = new Knight();

		foreach (self::$levels as $levelNumber => $generator) {
		    $isLevelSolved = false;
			$currentLevel = $generator();
			$attempts = 0;
			$lastMessage = null;

			while (!$isLevelSolved) {
			    $this->renderService->clearScreen($io);
			    $this->renderService->renderLevelHeading($io, $levelNumber);
				$this->renderService->renderAttempts($io, $attempts);
				$this->renderService->renderHP($io, $knight->getHP());
				$this->renderService->renderKnightAscii($io);

				if ($dumpChoice == 'tree') {
			        ArrayGenerator::dumpLevelTree($currentLevel);
				} else {
				    ArrayGenerator::dumpLevel($currentLevel);
				}

				if (!is_null($lastMessage)) {
					$io->info($lastMessage);
					$lastMessage = null;
				}

				$userInput = $this->renderService->renderUserAnswerField($io, $this->createValidator($currentLevel));
				$attempts++;
			    $target = PathValidator::evaluateDotNotationPath($currentLevel, $userInput);

				if (is_null($target)) {
                    $lastMessage = AppEnum::MISSED->value;
                    continue;
				}

				$isTargetMimic = Mimic::isTargetMimic($io, $target, $knight);

				if ($isTargetMimic) {
                    if (!$knight->isAlive()) {
                        $this->renderService->clearScreen($io);
                        $io->error(AppEnum::GAME_OVER->value);
                        return;
                    }

                    $lastMessage = AppEnum::MIMIC_DAMAGE->value;
                    continue;
				}

				$isTargetOrc = Orc::isTargetOrc($target);

				if ($isTargetOrc) {
				    $this->duelService->duel($io, $knight, $target, $lastMessage);
					continue;
				}

			    $isLevelSolved = Chest::isTargetChest($io, $target, $knight, $lastMessage);

				if ($isLevelSolved) {
                    $io->newLine();
                    $io->ask(AppEnum::GOODJOB->value);
                } else {
                    if (!$target instanceof Chest) {
                        $lastMessage = AppEnum::WRONG_TARGET->value;
                    }

                    continue;
                }
			}
		}

		$this->renderService->clearScreen($io);
        $this->renderService->renderVictory($io, $knight); // end of the game
	}

	/**
     * @param array<string|int, mixed> $currentLevel
     * @return \Closure
     */
	private function createValidator(array $currentLevel): \Closure
	{
        return function ($value) use ($currentLevel) {
            $clean = trim((string) $value);

            if ($clean === '') {
                throw new \InvalidArgumentException(AppEnum::EMPTY_PATH->value);
            }

            if (strtolower($clean) === AppEnum::EXIT->value) {
                return $clean;
            }

            return $clean;
        };
	}
}
