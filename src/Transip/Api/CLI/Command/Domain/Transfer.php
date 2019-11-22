<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Transfer extends AbstractCommand
{
    private const AUTH_CODE = 'AuthCode';

    protected function configure()
    {
        $this->setName('Domain:transfer')
            ->setDescription('Register a new domain')
            ->setHelp('Provide a name to retrieve your Domain by name')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(self::AUTH_CODE, InputArgument::REQUIRED, 'AuthCode');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $authCode   = $input->getArgument(self::AUTH_CODE);
        $this->getTransipApi()->domains()->transfer($domainName, $authCode);
    }
}
