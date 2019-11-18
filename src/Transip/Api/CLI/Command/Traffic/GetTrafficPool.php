<?php

namespace Transip\Api\CLI\Command\Traffic;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetTrafficPool extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Traffic:getTrafficPool')
            ->setDescription('Get all the traffic of your VPSes combined.')
            ->setHelp('This command outputs traffic information of your VPSes combined.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $trafficPool = $this->getTransipApi()->traffic()->getTrafficPool();
        $output->writeln(print_r($trafficPool,1));
    }
}
