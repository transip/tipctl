<?php

namespace Transip\Api\CLI\Command\AvailabilityZones;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('AvailabilityZones:getAll')
            ->setDescription('Lists the available AvailabilityZones')
            ->setHelp('This command displays all available zones where you can order a product.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $availabilityZones = $this->getTransipApi()->availabilityZone()->getAll();
        $this->output($availabilityZones);
    }
}
