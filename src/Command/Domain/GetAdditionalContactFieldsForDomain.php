<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAdditionalContactFieldsForDomain extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:additional-contact-fields')
            ->setDescription('Get all additional contact fields for a domain.')
            ->setHelp('Get all the additional fields needed to register or transfer a domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName       = $input->getArgument(Field::DOMAIN_NAME);
        $fields = $this->getTransipApi()->additionalContactFields()->getByDomainName($domainName);

        $this->output($fields);
        return 0;
    }
}
