<?php

namespace Transip\Api\CLI\Command\Vps\TCPMonitor\Contact;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Delete extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:tcpmonitor:contact:delete')
            ->setDescription('Remove a TCP Monitoring contact')
            ->addArgument(Field::CONTACT_ID, InputArgument::REQUIRED, Field::CONTACT_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $contactId = $input->getArgument(Field::CONTACT_ID);

        $this->getTransipApi()->vpsTCPMonitorContact()->delete($contactId);
        return 0;
    }
}
