<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\RenderService;

// php bin/console app:go
#[AsCommand(name: "app:go", description: "Runs Array Hunt")]
class GameCommand extends Command
{
	/** @var bool */
	protected static bool $isSolved = false;
	/** @var int */
	protected static int $attempts = 0; 
	
    /**
     * @return T
     */
    public function __construct(private RenderService $renderService)
    {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $io = new SymfonyStyle($input, $output);

        $this->renderService->renderIntro($io);
		//$this->renderService->renderIntroLevels($io);

		while (!self::$isSolved /* todo or not exited */) {
			$this->renderService->renderUserAnswerField($io);	
		}

        return Command::SUCCESS;
    }
}
