<?php

namespace Transip\Api\CLI\Command\Vps\TCPMonitor\Contact;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Create extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('vps:tcpmonitor:contact:create')
            ->setDescription('Create a TCP Monitoring contact')
            ->addArgument(Field::CONTACT_NAME, InputArgument::REQUIRED, Field::CONTACT_NAME__DESC)
            ->addArgument(Field::CONTACT_EMAIL, InputArgument::REQUIRED, Field::CONTACT_EMAIL__DESC)
            ->addArgument(Field::CONTACT_TELEPHONE, InputArgument::REQUIRED, Field::CONTACT_TELEPHONE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name      = $input->getArgument(Field::CONTACT_NAME);
        $email     = $input->getArgument(Field::CONTACT_EMAIL);
        $telephone = $input->getArgument(Field::CONTACT_TELEPHONE);

        $this->getTransipApi()->vpsTCPMonitorContact()->create($name, $telephone, $email);
    }
}
