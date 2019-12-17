<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Whois extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:whois')
            ->setDescription('Get the whois information for a registered domain')
            ->setHelp('Provide a domainName to retrieve the WHOIS information')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $domain = $this->getTransipApi()->domainWhois()->getByDomainName($domainName);
        $this->output($domain);
    }
}
