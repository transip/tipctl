<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class RemoveAttachedIpAddresses extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:removeattachedipaddresses')
            ->setDescription('Remove all of the IP\'s attached to your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);

        $this->getTransipApi()->haipIpAddresses()->delete($haipName);
        return 0;
    }
}
