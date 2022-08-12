<?php

namespace App\Command;

use App\Service\ProviderService;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'todos:import',
    description: 'This command imports all todos.',
)]
class ImportTodosCommand extends Command
{
    private ProviderService $providerService;

    public function __construct(ProviderService $providerService, string $name = null)
    {
        parent::__construct($name);
        $this->providerService = $providerService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->providerService->importTodos();
        }catch (Exception) {
            $io->error("An error occurred while todos importing.");
            return Command::FAILURE;
        }

        $io->success('All todos imported.');

        return Command::SUCCESS;
    }
}
