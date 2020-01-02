<?php

namespace Transip\Api\CLI\Command\ApiTest;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class ClearCache extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('apitest:clearcache')
            ->setDescription('Clear the Token cache')
            ->setHelp('Will force the generation of a new token');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getTransipApi()->clearCache();
        $this->output("Cache cleared");
    }
}
