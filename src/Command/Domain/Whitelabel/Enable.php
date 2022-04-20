<?php

namespace Transip\Api\CLI\Command\Domain\Whitelabel;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Enable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:whitelabel:enable')
            ->setDescription('Enable whitelabel for your domain, this cannot be reversed!')
            ->setHelp('Provide a domain name to set to whitelabel, can not be reversed!')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->setIsWhitelabel(true);
        $this->getTransipApi()->domains()->update($domain);
        return 0;
    }
}
