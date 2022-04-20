<?php

namespace Transip\Api\CLI\Command\Domain\Dns;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:dns:getbydomainname')
            ->setDescription('Get DNS Records for a domain')
            ->setHelp('Provide a name to retrieve the DNS Records for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $dnsEntries = $this->getTransipApi()->domainDns()->getByDomainName($domainName);
        $this->output($dnsEntries);
        return 0;
    }
}
