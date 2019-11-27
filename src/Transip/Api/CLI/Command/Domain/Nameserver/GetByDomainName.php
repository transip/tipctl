<?php

namespace Transip\Api\CLI\Command\Domain\Nameserver;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Domain:Nameserver:getByDomainName')
            ->setDescription('Get Nameservers for a domain')
            ->setHelp('Provide a name to retrieve the Nameservers for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName  = $input->getArgument(Field::DOMAIN_NAME);
        $nameservers = $this->getTransipApi()->domainNameserver()->getByDomainName($domainName);
        $this->output($nameservers);
    }
}
