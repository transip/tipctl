<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class Vps extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps')
            ->setDescription('TransIP Vpses')
            ->setHelp('vps listing and actions')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getAll")
            ->addUsage("getByName")
            ->addUsage("order")
            ->addUsage("clone")
            ->addUsage("setDescription")
            ->addUsage("setLock")
            ->addUsage("start")
            ->addUsage("stop")
            ->addUsage("reset")
            ->addUsage("cancel")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getAll":
                $vpses = $this->getTransipApi()->vps()->getAll();
                $output->writeln(print_r($vpses,1));
                break;
            case "getByName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("Vps name is required");
                }
                $vps = $this->getTransipApi()->vps()->getByName($arguments[0]);
                $output->writeln(print_r($vps,1));
                break;
            case "order":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("productName, operatingSystem is required. addons(comma separated), hostname, availabilityZone optional");
                }
                $productName      = $arguments[0];
                $operatingSystem  = $arguments[1];
                $addons           = $arguments[2] ?? '';
                $hostname         = $arguments[3] ?? '';
                $availabilityZone = $arguments[4] ?? '';

                if ($addons != '') {
                    $addons = explode(',', $addons);
                } else {
                    $addons = [];
                }

                $this->getTransipApi()->vps()->order(
                    $productName,
                    $operatingSystem,
                    $addons,
                    $hostname,
                    $availabilityZone
                );
                break;
            case "clone":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("source vps name is required, availabilityZone optional");
                }
                $availabilityZone = $arguments[1] ?? '';
                $this->getTransipApi()->vps()->cloneVps($arguments[0], $availabilityZone);
                break;
            case "setDescription":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and new description is required");
                }
                $vps = $this->getTransipApi()->vps()->getByName($arguments[0]);
                $vps->setDescription($arguments[1]);
                $this->getTransipApi()->vps()->update($vps);
                $output->writeln(print_r($vps,1));
                break;
            case "setLock":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("Vps name is required");
                }
                $vps = $this->getTransipApi()->vps()->getByName($arguments[0]);
                $vps->setIsCustomerLocked((bool)$arguments[1]);
                $this->getTransipApi()->vps()->update($vps);
                $output->writeln(print_r($vps,1));
                break;
            case "start":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("Vps name is required");
                }
                $this->getTransipApi()->vps()->start($arguments[0]);
                break;
            case "stop":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("Vps name is required");
                }
                $this->getTransipApi()->vps()->stop($arguments[0]);
                break;
            case "reset":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("Vps name is required");
                }
                $this->getTransipApi()->vps()->reset($arguments[0]);
                break;
            case "cancel":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and cancellation time (end|immediately) is required");
                }
                $this->getTransipApi()->vps()->cancel($arguments[0], $arguments[1]);
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
