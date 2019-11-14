<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class SetLock extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Vps:setLock')
            ->setDescription('Lock a Vps')
            ->setHelp('Provide a Vps name and 1 or a 0 for locking or unlocking')
            ->addArgument('args', InputArgument::IS_ARRAY, 'Optional arguments');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('args');

        if (count($arguments) < 2) {
            throw new \Exception("Vps name is required");
        }

        $vps = $this->getTransipApi()->vps()->getByName($arguments[0]);
        $vps->setIsCustomerLocked((bool)$arguments[1]);
        $this->getTransipApi()->vps()->update($vps);

        $output->writeln(print_r($vps,1));
    }
}