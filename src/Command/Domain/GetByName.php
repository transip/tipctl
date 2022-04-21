<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:getbyname')
            ->setDescription('Get specific domain by its domainname')
            ->setHelp('Provide a name to retrieve your Domain by name')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addOption(Field::INCLUDE, null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, FIELD::INCLUDE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $includes = $input->getOption(Field::INCLUDE) ?? [];

        $domain = $this->getTransipApi()->domains()->getByName($domainName, $includes);
        $this->output($domain);
        return 0;
    }
}
