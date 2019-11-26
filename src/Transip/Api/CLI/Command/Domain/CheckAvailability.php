<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class CheckAvailability extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:checkAvailability')
            ->setDescription('check if a domain is available for registration')
            ->setHelp('Provide a domainName to retrieve the registration status')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $domain = $this->getTransipApi()->domainAvailability()->checkDomainName($domainName);
        $this->output($domain);
    }
}
