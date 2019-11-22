<?php

namespace Transip\Api\CLI\Command\Domain\Branding;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:Branding:getByDomainName')
            ->setDescription('Get branding information for a domain')
            ->setHelp('Provide a name to retrieve the branding information for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $domain = $this->getTransipApi()->domainBranding()->getByDomainName($domainName);
        $output->writeln(print_r($domain,1));
    }
}
