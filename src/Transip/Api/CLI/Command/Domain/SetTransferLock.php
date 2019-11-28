<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetTransferLock extends AbstractCommand
{
    private const TRANSFER_LOCK = 'TransferLock';

    protected function configure(): void
    {
        $this->setName('Domain:setTransferLock')
            ->setDescription('Set Domain transfer lock at the registry')
            ->setHelp('Provide a domain name and true or a false for locking or unlocking')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(self::TRANSFER_LOCK, InputArgument::REQUIRED, 'Transfer Lock (true|false)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName   = $input->getArgument(Field::DOMAIN_NAME);
        $transferLock = $input->getArgument(self::TRANSFER_LOCK);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->setIsTransferLocked(filter_var($transferLock, FILTER_VALIDATE_BOOLEAN));
        $this->getTransipApi()->domains()->update($domain);

        $this->output($domain);
    }
}
