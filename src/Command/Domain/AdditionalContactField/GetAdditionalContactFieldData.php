<?php

namespace Transip\Api\CLI\Command\Domain\AdditionalContactField;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAdditionalContactFieldData extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:contact:getadditionaldata')
            ->setDescription('Get additional contact field data for a domain')
            ->setHelp('Provide a name to retrieve the current running action for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);

        $this->output($this->getTransipApi()->additionalContactFieldData()->getByDomainName($domainName));

        return 0;
    }
}
