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
            ->setHelp('the different places a product can be in or placed')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getAll")
            ->addUsage("getByName")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getAll":
                $availabilityZones = $this->getTransipApi()->availabilityZone()->getAll();
                $output->writeln(print_r($availabilityZones,1));
                break;
            case "getByName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("AvailabilityZone name is required");
                }
                $availabilityZone = $this->getTransipApi()->availabilityZone()->getByName($arguments[0]);
                $output->writeln(print_r($availabilityZone,1));
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
