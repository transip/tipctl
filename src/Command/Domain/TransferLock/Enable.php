<?php

namespace Transip\Api\CLI\Command\Domain\TransferLock;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Enable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:transferlock:enable')
            ->setDescription('Enable transfer lock for your domain')
            ->setHelp('Provide a domain name to lock a domain from being transferred')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName   = $input->getArgument(Field::DOMAIN_NAME);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->setIsTransferLocked(true);
        $this->getTransipApi()->domains()->update($domain);
    }
}
