<?php

namespace Transip\Api\CLI\Command\Vps\TCPMonitor\Contact;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('vps:tcpmonitor:contact:getall')
            ->setDescription('List all existing TCP Monitoring contacts');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getTransipApi()->vpsTCPMonitorContact()->getAll();

        $this->output($response);
    }
}
