<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAttachedIpAddresses extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Haip:getAttachedIpAddresses')
            ->setDescription('Get all of the ips that are attached to your Haip')
            ->addArgument('haipName', InputArgument::REQUIRED, 'name of haip');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument('haipName');
        $ipAddresses = $this->getTransipApi()->haipIpAddresses()->getByHaipName($haipName);

        $this->output($ipAddresses);
    }
}