<?php

namespace Transip\Api\CLI\Command\Vps\TCPMonitor;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:tcpmonitor:getbyvpsname')
            ->setDescription('List all TCP monitors on your VPS')
            ->setHelp('')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);

        $response = $this->getTransipApi()->vpsTCPMonitor()->getByVpsName($vpsName);
        $this->output($response);
    }
}
