<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Transfer extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:transfer')
            ->setDescription('Register a new domain')
            ->setHelp('Provide a name to retrieve your Domain by name')
            ->addArgument('DomainName', InputArgument::REQUIRED, 'DomainName')
            ->addArgument('AuthCode', InputArgument::REQUIRED, 'AuthCode');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument('DomainName');
        $authCode   = $input->getArgument('AuthCode');
        $this->getTransipApi()->domains()->transfer($domainName, $authCode);
    }
}
