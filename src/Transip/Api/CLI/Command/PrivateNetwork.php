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
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getAll")
            ->addUsage("getByName")
            ->addUsage("order")
            ->addUsage("setDescription")
            ->addUsage("addVps")
            ->addUsage("removeVps")
            ->addUsage("cancel")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getAll":
                $privateNetworks = $this->getTransipApi()->privateNetworks()->getAll();
                $output->writeln(print_r($privateNetworks,1));
                break;
            case "getByName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new Exception("PrivateNetwork name is required");
                }
                $privateNetwork = $this->getTransipApi()->privateNetworks()->getByName($arguments[0]);
                $output->writeln(print_r($privateNetwork,1));
                break;
            case "order":
                $this->getTransipApi()->privateNetworks()->order();
                break;
            case "setDescription":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new Exception("PrivateNetworkName and description is required");
                }
                $privateNetwork = $this->getTransipApi()->privateNetworks()->getByName($arguments[0]);
                $privateNetwork->setDescription($arguments[1]);
                $this->getTransipApi()->privateNetworks()->update($privateNetwork);
                break;
            case "addVps":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new Exception("PrivateNetworkName and vpsName is required");
                }
                $this->getTransipApi()->privateNetworks()->addVps($arguments[0],$arguments[1]);
                break;
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
                    throw new Exception("PrivateNetwork and cancellation time (end|immediately) is required");
                }
                $this->getTransipApi()->privateNetworks()->cancel($arguments[0], $arguments[1]);
                break;
            default:
                throw new Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
