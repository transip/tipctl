<?php

namespace Transip\Api\CLI\Command\Domain\AutoDns;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Enable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:autodns:enable')
            ->setDescription('Enable autodns for your domain')
            ->setHelp('Provide a domain name to enable the autoDns feature')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName   = $input->getArgument(Field::DOMAIN_NAME);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->setHasAutoDns(true);
        $this->getTransipApi()->domains()->update($domain);
        return 0;
    }
}
