<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Cancel extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps:cancel')
            ->setDescription('Cancel a Vps')
            ->setHelp('Provide a Vps name to cancel and a cancellation time (end|immediately)')
            ->addArgument('args', InputArgument::IS_ARRAY, 'Optional arguments');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('args');

        if (count($arguments) < 2) {
            throw new \Exception("VpsName and cancellation time (end|immediately) is required");
        }

        $this->getTransipApi()->vps()->cancel($arguments[0]);
    }
}
