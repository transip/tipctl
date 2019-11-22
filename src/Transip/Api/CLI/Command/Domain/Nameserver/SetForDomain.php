<?php

namespace Transip\Api\CLI\Command\Domain\Nameserver;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Client\Entity\Domain\Nameserver;

class SetForDomain extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:Nameserver:setForDomain')
            ->setDescription('Update all Nameservers for a domain')
            ->setHelp('Provide all hostnames of the Nameservers for the domain, comma separate multiple')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DOMAIN_NAMESERVERS, InputArgument::REQUIRED, Field::DOMAIN_NAMESERVERS__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName  = $input->getArgument(Field::DOMAIN_NAME);
        $nameservers = $input->getArgument(Field::DOMAIN_NAMESERVERS);

        $nameservers       = explode(',', $nameservers);
        $nameserverObjects = [];

        foreach ($nameservers as $nameserver) {
            $nameserverObject = new Nameserver();
            $nameserverObject->setHostname($nameserver);
            $nameserverObjects[] = $nameserverObject;
        }

        $this->getTransipApi()->domainNameserver()->update($domainName, $nameserverObjects);
    }
}
