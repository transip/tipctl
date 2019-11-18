<?php

namespace Transip\Api\CLI\Command;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class PrivateNetwork extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('PrivateNetwork')
            ->setDescription('TransIP Vps Private networks')
            ->setHelp('Private networks for TransIP Vpses')
            ->addArgument("action", InputArgument::REQUIRED, '')
            ->addUsage("removeVps")
            ->addUsage("cancel")
            ->addArgument("args", InputArgument::IS_ARRAY, 'Optional arguments');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "removeVps":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new Exception("PrivateNetworkName and vpsName is required");
                }
                $this->getTransipApi()->privateNetworks()->removeVps($arguments[0],$arguments[1]);
                break;
            case "cancel":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new Exception("PrivateNetworkName and cancellation time (end|immediately) is required");
                }
                $this->getTransipApi()->privateNetworks()->cancel($arguments[0], $arguments[1]);
                break;
            default:
                throw new Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
