<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetIsWhitelabel extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:setIsWhitelabel')
            ->setDescription('Set domain to whitelabel, this cannot be reversed!')
            ->setHelp('Provide a domain name to set to whitelabel, can not be reversed!')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->setIsWhitelabel(true);
        $this->getTransipApi()->domains()->update($domain);

        $this->output($domain);
    }
}
