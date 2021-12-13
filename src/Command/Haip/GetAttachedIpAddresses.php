<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAttachedIpAddresses extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:getattachedipaddresses')
            ->setDescription('Get all of the IP\'s that are attached to your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $ipAddresses = $this->getTransipApi()->haipIpAddresses()->getByHaipName($haipName);

        $this->output($ipAddresses);
    }
}
