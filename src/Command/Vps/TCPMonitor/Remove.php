<?php

namespace Transip\Api\CLI\Command\Vps\TCPMonitor;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Remove extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:tcpmonitor:delete')
            ->setDescription('Remove a TCP Monitor from your VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::TCP_IPADDRESS, InputArgument::REQUIRED, Field::TCP_IPADDRESS__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName   = $input->getArgument(Field::VPS_NAME);
        $ipAddress = $input->getArgument(Field::TCP_IPADDRESS);

        $this->getTransipApi()->vpsTCPMonitor()->delete($vpsName, $ipAddress);
    }
}
