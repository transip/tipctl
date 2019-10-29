<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\CLI\Command\AbstractCommand;

class Addon extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('VpsAddon')
            ->setDescription('TransIP Vps Addons')
            ->setHelp('Get the current,available and cancellable addons for a VPS.')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getByVpsName")
            ->addUsage("order")
            ->addUsage("cancel")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getByVpsName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("Vps name is required");
                }
                $vps = $this->getTransipApi()->vpsAddons()->getByVpsName($arguments[0]);
                $output->writeln(print_r($vps, 1));
                break;
            case "order":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("vpsName, addons(comma separated)");
                }
                $vpsName = $arguments[0];
                $addons  = $arguments[1];

                $addons = explode(',', $addons);

                $this->getTransipApi()->vpsAddons()->order(
                    $vpsName,
                    $addons
                );
                break;
            case "cancel":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and AddonName required");
                }
                $this->getTransipApi()->vpsAddons()->cancel($arguments[0], $arguments[1]);
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
