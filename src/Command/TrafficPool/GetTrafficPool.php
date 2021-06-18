<?php

namespace Transip\Api\CLI\Command\TrafficPool;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetTrafficPool extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('trafficpool:gettrafficpool')
            ->setDescription('Get all the Traffic Pool information of your VPSs combined.')
            ->setHelp('This command outputs Traffic Pool information of your VPSs combined.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $trafficPool = $this->getTransipApi()->trafficPool()->getTrafficPool();
        $this->output($trafficPool);
    }
}
