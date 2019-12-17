<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class CloneVps extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:cloneVps')
            ->setDescription('Clone an existing VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::AVAILABILITY_ZONE, InputArgument::OPTIONAL, Field::AVAILABILITY_ZONE__DESC . Field::OPTIONAL, '')
            ->setHelp('You must provide the vps name of the VPS to clone, and optionally provide the name of the availability zone where the clone should be created');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $availabilityZone = $input->getArgument(Field::AVAILABILITY_ZONE);

        $this->getTransipApi()->vps()->cloneVps($vpsName, $availabilityZone);
    }
}
