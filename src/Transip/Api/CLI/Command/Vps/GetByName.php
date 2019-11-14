<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetByName extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Vps:getByName')
            ->setDescription('Get your Vps by name')
            ->setHelp('Provide a name to retrieve your Vps by name')
            ->addArgument('args', InputArgument::IS_ARRAY, 'Optional arguments');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('args');

        if (count($arguments) < 1) {
            throw new \Exception('Vps name is required');
        }

        $vps = $this->getTransipApi()->vps()->getByName($arguments[0]);

        $output->writeln(print_r($vps,1));
    }
}