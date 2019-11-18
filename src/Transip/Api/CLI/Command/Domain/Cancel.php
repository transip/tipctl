<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Cancel extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:cancel')
            ->setDescription('Get specific domain by its domainname')
            ->setHelp('Provide a domainName and canceltime (end|immediately) to cancel a domain')
            ->addArgument('DomainName', InputArgument::REQUIRED, 'DomainName')
            ->addArgument('CancelTime', InputArgument::REQUIRED, 'CancelTime');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument('DomainName');
        $cancelTime = $input->getArgument('CancelTime');
        $this->getTransipApi()->domains()->cancel($domainName, $cancelTime);
    }
}
