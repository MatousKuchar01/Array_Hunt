<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\RenderService;

// php bin/console app:go
#[AsCommand(name: "app:go", description: "Spustí hru Array Hunt")]
class GameCommand extends Command
{
    /**
     * @return T
     */
    public function __construct(private RenderService $service)
    {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $io = new SymfonyStyle($input, $output);

        $this->service->renderIntro($io);

        return Command::SUCCESS;
    }
}
