<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\Client\Exception\HttpRequest\NotFoundException;

class Traffic extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Traffic')
            ->setDescription('Traffic usage for TrafficPool or specific VPS')
            ->setHelp('information about the network usage for your VPS or the whole traffic pool')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getTrafficPool")
            ->addUsage("getByVpsName")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getTrafficPool":
                $trafficPool = $this->getTransipApi()->traffic()->getTrafficPool();
                $output->writeln(print_r($trafficPool,1));
                break;
            case "getByVpsName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("Vps name is required");
                }
                $traffic = $this->getTransipApi()->traffic()->getByVpsName($arguments[0]);
                $output->writeln(print_r($traffic,1));
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
