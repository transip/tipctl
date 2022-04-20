<?php

namespace Transip\Api\CLI\Command\ApiUtil;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Test extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('apiutil:test')
            ->setDescription('Check your API connection and token via this simple test')
            ->setHelp('Will check if the API is reachable with token');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $timeStart = microtime(true);
        $success   = $this->getTransipApi()->test()->test();
        $timeDone  = microtime(true);

        if ($success) {
            $output->writeln('<fg=green>API connection successful</>');
        } else {
            $output->writeln("<fg=red>API connection failed!</>");
        }
        $ping = round(($timeDone - $timeStart) * 1000);
        $output->writeln("Elapsed time: {$ping} ms");
        return 0;
    }
}
