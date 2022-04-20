<?php

namespace Transip\Api\CLI\Command\Vps\TCPMonitor\Contact;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Vps\Contact;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:tcpmonitor:contact:update')
            ->setDescription('Update a TCP Monitoring contact')
            ->addArgument(Field::CONTACT_ID, InputArgument::REQUIRED, Field::CONTACT_ID__DESC)
            ->addArgument(Field::CONTACT_NAME, InputArgument::REQUIRED, Field::CONTACT_NAME__DESC)
            ->addArgument(Field::CONTACT_EMAIL, InputArgument::REQUIRED, Field::CONTACT_EMAIL__DESC)
            ->addArgument(Field::CONTACT_TELEPHONE, InputArgument::REQUIRED, Field::CONTACT_TELEPHONE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $contactId        = $input->getArgument(Field::CONTACT_ID);
        $contactName      = $input->getArgument(Field::CONTACT_NAME);
        $contactEmail     = $input->getArgument(Field::CONTACT_EMAIL);
        $contactTelephone = $input->getArgument(Field::CONTACT_TELEPHONE);

        $contact = new Contact();
        $contact->setId($contactId);
        $contact->setName($contactName);
        $contact->setEmail($contactEmail);
        $contact->setTelephone($contactTelephone);

        $this->getTransipApi()->vpsTCPMonitorContact()->update($contact);
        return 0;
    }
}
