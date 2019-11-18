<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Register extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:register')
            ->setDescription('Register a new domain')
            ->setHelp('Provide a name to retrieve your Domain by name')
            ->addArgument('DomainName', InputArgument::REQUIRED, 'DomainName');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument('DomainName');
        $this->getTransipApi()->domains()->register($domainName);
    }
}
