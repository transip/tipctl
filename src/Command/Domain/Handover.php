<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Handover extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:handover')
            ->setDescription('Handover a Domain to another TransIP Customer')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::CUSTOMER_NAME, InputArgument::REQUIRED, Field::CUSTOMER_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName   = $input->getArgument(Field::DOMAIN_NAME);
        $customerName = $input->getArgument(Field::CUSTOMER_NAME);

        $this->getTransipApi()->domains()->handover($domainName, $customerName);

        return 0;
    }
}
