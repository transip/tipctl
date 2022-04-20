<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class OrderWhitelabel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:orderwhitelabel')
            ->setDescription('Order domain whitelabel services for your account')
            ->setHelp('Order the whitelabel services for this account');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getTransipApi()->domainWhitelabel()->order();
        return 0;
    }
}
