<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Transfer extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:transfer')
            ->setDescription('Transfer a domain to your account')
            ->setHelp('Provide a name to retrieve your Domain by name')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DOMAIN_AUTH_CODE, InputArgument::REQUIRED, Field::DOMAIN_AUTH_CODE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $authCode   = $input->getArgument(Field::DOMAIN_AUTH_CODE);
        $this->getTransipApi()->domains()->transfer($domainName, $authCode);
    }
}
