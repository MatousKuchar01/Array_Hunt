<?php

namespace App;

use App\Enum\Loot;
use App\Generator\ArrayGeneratorV1;
use App\Util\Chest;
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

		while (!$this->isSolved) {
			// todo level 1 heading
			$levelOne = ArrayGenerator::generateFirstLevel();
			ArrayGenerator::dumpLevel($levelOne);

			// get callable validate dot input

			$userInput = $this->renderService->renderUserAnswerField($io, $validator);

			$target = $this->evaluatePath($maze, $userInput);
			
            if ($target instanceof Chest) {
            	// opens chest
            } else {
            	// fail message
            }
		}
	}
}
