<?php

declare(strict_types=1);

namespace App;

use App\Enum\AppEnum;
use App\Generator\ArrayGenerator;
use App\Validator\PathValidator;
use App\Util\Chest;
use App\Service\RenderService;
use Symfony\Component\Console\Style\SymfonyStyle;

class Engine
{
    /** @var array<int, callable(): array<string|int, mixed>> */
	protected static array $levels = [];

	public function __construct(private RenderService $renderService) {}

	/**
	 * main game loop
	 * @param SymfonyStyle $io
     * @return void
	 */
	public function play(SymfonyStyle $io): void
	{
		$this->renderService->renderIntro($io);

		self::$levels = [
            1 => fn() => ArrayGenerator::generateFirstLevel(),
            2 => fn() => ArrayGenerator::generateSecondLevel(),
            3 => fn() => ArrayGenerator::generateThirdLevel(),
		];

		foreach (self::$levels as $levelNumber => $generator) {
		    $isLevelSolved = false;
			$currentLevel = $generator();
			$this->renderService->clearScreen($io);
			$this->renderService->renderLevelHeading($io, $levelNumber);

			while (!$isLevelSolved) {
			    ArrayGenerator::dumpLevel($currentLevel);
				$userInput = $this->renderService->renderUserAnswerField($io, $this->createValidator($currentLevel));
			    $target = PathValidator::evaluateDotNotationPath($currentLevel, $userInput);
			    $isLevelSolved = Chest::isTargetChest($io, $target);

				if ($isLevelSolved) {
                    $io->newLine();
                    $io->ask('Great job knight! Press ENTER to continue to the next level...');
                }
			}
		}
	}

	/**
     * @param array<string|int, mixed> $currentLevel
     * @return \Closure
     */
	private function createValidator(array $currentLevel): \Closure
	{
        return function ($value) use ($currentLevel) {
            $clean = trim((string) $value);

            if (strtolower($clean) === AppEnum::EXIT->value) {
                return $clean;
            }

            $target = PathValidator::evaluateDotNotationPath($currentLevel, $clean);

            if ($target === null) {
                throw new \InvalidArgumentException(AppEnum::MISSED->value);
            }

            return $clean;
        };
	}
}
