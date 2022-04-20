<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class CheckAvailability extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:checkavailability')
            ->setDescription('Check if a domain is available for registration')
            ->setHelp('Provide a domainName to retrieve the registration status')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $domain = $this->getTransipApi()->domainAvailability()->checkDomainName($domainName);
        $this->output($domain);
        return 0;
    }
}
