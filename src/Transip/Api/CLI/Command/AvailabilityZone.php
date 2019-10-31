<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class AvailabilityZone extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('AvailabilityZone')
            ->setDescription('TransIP AvailabilityZones')
            ->setHelp('the different locations a product can be in')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getAll")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getAll":
                $availabilityZones = $this->getTransipApi()->availabilityZone()->getAll();
                $output->writeln(print_r($availabilityZones,1));
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
