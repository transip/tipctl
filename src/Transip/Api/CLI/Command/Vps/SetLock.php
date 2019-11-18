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
            ->setHelp('Provide a Vps name and true or a false for locking or unlocking')
            ->addArgument('VpsName', InputArgument::REQUIRED, 'VpsName')
            ->addArgument('SetLock', InputArgument::REQUIRED, 'SetLock');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument('VpsName');
        $setLock = $input->getArgument('SetLock');

        $vps = $this->getTransipApi()->vps()->getByName($vpsName);
        $vps->setIsCustomerLocked(filter_var($setLock, FILTER_VALIDATE_BOOLEAN));
        $this->getTransipApi()->vps()->update($vps);

        $output->writeln(print_r($vps,1));
    }
}
