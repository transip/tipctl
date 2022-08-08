<?php

namespace Transip\Api\CLI\Command\Domain\AuthCode;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Get extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:auth-code:get')
            ->setDescription('Get the auth-code for a registered domain')
            ->setHelp('Provide a domainName')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $domain = $this->getTransipApi()->domainAuthCode()->getByDomainName($domainName);
        $this->output($domain);
        return 0;
    }
}
