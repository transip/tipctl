<?php

namespace Transip\Api\CLI\Command\Domain\AutoDns;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Disable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:autodns:disable')
            ->setDescription('Disable autodns for your domain')
            ->setHelp('Provide a domain name to disable the autoDns feature')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName   = $input->getArgument(Field::DOMAIN_NAME);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->setHasAutoDns(false);
        $this->getTransipApi()->domains()->update($domain);
    }
}
