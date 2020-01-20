<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Cancel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:cancel')
            ->setDescription('Cancel a specific domain by its domainname')
            ->setHelp('Provide a domainName and canceltime (end|immediately) to cancel a domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::CANCELTIME, InputArgument::REQUIRED, Field::CANCELTIME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $cancelTime = $input->getArgument(Field::CANCELTIME);
        $this->getTransipApi()->domains()->cancel($domainName, $cancelTime);
    }
}
