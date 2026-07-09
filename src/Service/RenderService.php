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
        $io->ask(AppEnum::PRESS_ENTER_TO_START->value);
        $io->write("\033[2J\033[;H");
    }
}
