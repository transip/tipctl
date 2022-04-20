<?php

namespace Transip\Api\CLI\Command\Domain\Action;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Cancel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:action:cancel')
            ->setDescription('Get cancel current action for a domain')
            ->setHelp('Provide a name to cancel the action currently running for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $this->getTransipApi()->domainAction()->cancelAction($domainName);
        return 0;
    }
}
