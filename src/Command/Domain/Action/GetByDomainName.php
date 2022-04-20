<?php

namespace Transip\Api\CLI\Command\Domain\Action;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:action:getbydomainname')
            ->setDescription('Get current action for a domain')
            ->setHelp('Provide a name to retrieve the current running action for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $action     = $this->getTransipApi()->domainAction()->getByDomainName($domainName);
        $this->output($action);
        return 0;
    }
}
