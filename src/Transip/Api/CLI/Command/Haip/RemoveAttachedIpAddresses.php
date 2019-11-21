<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class RemoveAttachedIpAddresses extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Haip:removeAttachedIpAddresses')
            ->setDescription('Remove all of the ips attached to your Haip')
            ->addArgument('haipName', InputArgument::REQUIRED, 'name of Haip');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument('haipName');

        $this->getTransipApi()->haipIpAddresses()->delete($haipName);
    }
}