<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class SetAttachedIpAddresses extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Haip:setAttachedIpAddresses')
            ->setDescription('Set the ips to attach to your Haip')
            ->addArgument('haipName', InputArgument::REQUIRED, 'name of Haip')
            ->addArgument('ipAddresses', InputArgument::REQUIRED, 'IpAddresses ipv4 or/and ipv6 (comma separated)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument('haipName');
        $ipAddresses = $input->getArgument('ipAddresses');
        $ipAddresses = explode(',', $ipAddresses);

        $this->getTransipApi()->haipIpAddresses()->update($haipName, $ipAddresses);
    }
}