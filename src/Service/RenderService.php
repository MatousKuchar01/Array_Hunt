<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\AppEnum;
use App\Util\Knight;
use Symfony\Component\Console\Style\SymfonyStyle;

class RenderService
{
    /**
     * @param SymfonyStyle $io
     * @return void
     */
    public function renderIntro(SymfonyStyle $io): void
    {
        $io->title(AppEnum::APP_TITLE->value);
        $io->section(AppEnum::APP_DESCRIPTION->value);
        $io->section(AppEnum::STORY_DESCRIPTION->value);
        $io->section(AppEnum::APP_TIPS->value);
        $io->ask(AppEnum::PRESS_ENTER_TO_START->value);
        $io->write("\033[2J\033[;H");
    }

    /**
     * @param SymfonyStyle $io
     * @param int $levelNumber
     * @return void
     */
    public function renderLevelHeading(SymfonyStyle $io, int $levelNumber)
    {
        $io->section("--- LEVEL {$levelNumber} ---");
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     */
    public function clearScreen(SymfonyStyle $io): void
    {
        $io->write("\033[2J\033[;H");
    }

    /**
     * @param SymfonyStyle $io
     * @param int $attempts
     * @return void
     */
    public function renderAttempts(SymfonyStyle $io, int $attempts): void
    {
		$io->text(AppEnum::ATTEMPTS_TEXT->value . ' ' . $attempts);
		$io->newLine();
    }

    /**
     * @param SymfonyStyle $io
     * @param int $hp
     * @return void
     */
    public function renderHP(SymfonyStyle $io, int $hp): void
    {
		$io->text(AppEnum::HP_TEXT->value . ' ' . Knight::convertHPToHearts($hp));
		$io->newLine();
    }

    /**
     * @param SymfonyStyle $io
     * @param callable $validator
     * @return string
     */
    public function renderUserAnswerField(SymfonyStyle $io, callable $validator): string
    {
       	$answer = $io->ask(AppEnum::PROMPT_USER->value, null, $validator);

		if (strtolower($answer) === AppEnum::EXIT->value) {
	    	$io->warning(AppEnum::GOODBYE->value);
		    exit;
		}

       	return (string) $answer;
    }
}
