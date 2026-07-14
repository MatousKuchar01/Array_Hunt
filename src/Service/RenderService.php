<?php

namespace App\Service;

use App\Enum\AppEnum;
use Symfony\Component\Console\Style\SymfonyStyle;

class RenderService
{
    /**
     * @return void
     */
    public function renderIntro(SymfonyStyle $io): void
    {
        $io->title(AppEnum::APP_TITLE->value);
        $io->section(AppEnum::APP_DESCRIPTION->value);
        $io->section(AppEnum::STORY_DESCRIPTION->value);
        $io->ask(AppEnum::PRESS_ENTER_TO_START->value);
        $io->write("\033[2J\033[;H");
    }

    public function renderIntroLevels()
    {
    	$maze = ArrayGenerator::generateLevel1();
    	        
        $displayMaze = $maze;

    	array_walk_recursive($displayMaze, function (&$item) {
			if ($item instanceof \App\Util\Chest) {
  	                $item = (string) $item;
   	            }
	        });
    	        
        dump($displayMaze);
    }

    public function renderAttempts(SymfonyStyle $io, int $attempts)
    {
		$io->text(AppEnum::ATTEMPTS_TEXT->value . ' ' . string($attempts));    		
    }

    public function renderUserAnswerField(SymfonyStyle $io): void
    {
       	$io->ask(AppEnum::PROMPT_USER->value); 	
    }
}
