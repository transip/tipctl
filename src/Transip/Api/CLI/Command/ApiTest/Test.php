<?php

namespace Transip\Api\CLI\Command\ApiTest;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Test extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('ApiTest:test')
            ->setDescription('Check your API connection and token via this simple test')
            ->setHelp('Will check if the API is reachable with token');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $success = $this->getTransipApi()->test()->test();
        $this->output(['success' => $success]);
    }
}
