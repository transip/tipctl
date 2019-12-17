<?php

namespace Transip\Api\CLI\Command\MailService;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AddDnsEntriesToDomains extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('mailService:addDnsEntriesToDomains')
            ->setDescription('Add dns entries for the mailservice to a given domain')
            ->setHelp('domain(s) (comma separated) is required')
            ->addArgument(Field::DOMAIN_NAMES, InputArgument::REQUIRED, Field::DOMAIN_NAMES__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainNames = $input->getArgument(Field::DOMAIN_NAMES);
        $domains = explode(',', $domainNames);

        $this->getTransipApi()->mailService()->addMailServiceDnsEntriesToDomains($domains);
    }
}
