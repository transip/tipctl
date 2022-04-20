<?php

namespace Transip\Api\CLI\Command\Domain\DnsSec;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:dnssec:getbydomainname')
            ->setDescription('Get DNSSEC Entries for a domain')
            ->setHelp('Provide a name to retrieve the DNSSEC Entries for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName    = $input->getArgument(Field::DOMAIN_NAME);
        $dnsSecEntries = $this->getTransipApi()->domainDnsSec()->getByDomainName($domainName);
        $this->output($dnsSecEntries);
        return 0;
    }
}
