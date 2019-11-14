<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Reset extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Vps:reset')
            ->setDescription('Reset a Vps')
            ->setHelp('Provide a Vps name to reset')
            ->addArgument('args', InputArgument::IS_ARRAY, 'Optional arguments');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('args');

        if (count($arguments) < 1) {
            throw new \Exception("Vps name is required");
        }

        $this->getTransipApi()->vps()->reset($arguments[0]);
    }
}