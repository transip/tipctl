<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class CloneVps extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Vps:cloneVps')
            ->setDescription('Clone a given Vps')
            ->setHelp('Provide a Vps name of which you want a Vps clone')
            ->addArgument('args', InputArgument::IS_ARRAY, 'Optional arguments');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('args');

        if (count($arguments) < 1) {
            throw new \Exception("source vps name is required, availabilityZone optional");
        }

        $availabilityZone = $arguments[1] ?? '';

        $this->getTransipApi()->vps()->cloneVps($arguments[0], $availabilityZone);
    }

}