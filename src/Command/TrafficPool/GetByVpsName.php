<?php

namespace Transip\Api\CLI\Command\TrafficPool;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('trafficpool:getbyvpsname')
            ->setDescription('Get Traffic Pool information for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('This command prints Traffic Pool information for a given vps.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $traffic = $this->getTransipApi()->trafficPool()->getByVpsName($vpsName);
        $this->output($traffic);
    }
}
