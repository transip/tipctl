<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class SetTransferLock extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:setTransferLock')
            ->setDescription('Set Domain transfer lock at the registry')
            ->setHelp('Provide a domain name and true or a false for locking or unlocking')
            ->addArgument('DomainName', InputArgument::REQUIRED, 'DomainName')
            ->addArgument('TransferLock', InputArgument::REQUIRED, 'TransferLock');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName   = $input->getArgument('DomainName');
        $transferLock = $input->getArgument('TransferLock');

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->setIsTransferLocked(filter_var($transferLock, FILTER_VALIDATE_BOOLEAN));
        $this->getTransipApi()->domains()->update($domain);

        $this->output($domain);
    }
}
