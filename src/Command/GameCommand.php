<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Enum\AppEnum;

// php bin/console app:go
#[AsCommand(name: "app:go", description: "Spustí hru Array Hunt")]
class GameCommand extends Command
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $io = new SymfonyStyle($input, $output);

        $io->title(AppEnum::APP_TITLE->value);

        return Command::SUCCESS;
    }
}
