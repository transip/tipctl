<?php

namespace Transip\Api\CLI\Command\ApiUtil;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class ClearCache extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('apiutil:clearcache')
            ->setDescription('Clear the Token cache')
            ->setHelp('Will force the generation of a new token');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getTransipApi()->clearCache();
        $output->writeLn("<fg=green>TransIP API library cache cleared</>");
        return 0;
    }
}
