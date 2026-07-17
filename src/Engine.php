<?php

namespace App;

use App\Enum\Loot;
use App\Enum\AppEnum;
use App\Generator\ArrayGenerator;
use App\Validator\PathValidator;
use App\Util\Chest;
use App\Service\RenderService;
use Symfony\Component\Console\Style\SymfonyStyle;

class Engine
{
	/** @var bool */
	protected static bool $isSolved = false;
	/** @var int */
	protected static int $attempts = 0;	

	public function __construct(private RenderService $renderService) {}

	/**
	* main game loop
	*/
	public function play(SymfonyStyle $io): void
	{
		$this->renderService->renderIntro($io);

		while (!self::$isSolved) {
			// todo level 1 heading
			$levelOne = ArrayGenerator::generateFirstLevel();
			ArrayGenerator::dumpLevel($levelOne);

			// Definujeme validátor na míru aktuálnímu bludišti
            $validator = function ($value) use ($levelOne) {
            $clean = trim((string) $value);
			
            if (strtolower($clean) === 'exit') {
                return $clean;
            }
			
            $target = PathValidator::evaluateDotNotationPath($levelOne, $clean);
               if ($target === null) {
                  throw new \InvalidArgumentException(AppEnum::MISSED->value);
            }
			
                return $clean;
            };

			$userInput = $this->renderService->renderUserAnswerField($io, $validator);
			
			$target = PathValidator::evaluateDotNotationPath($levelOne, $userInput);
			Chest::isTargetChest($io, $target);
		}
	}
}
