<?php

namespace Transip\Api\CLI\Command\Vps;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\CLI\Command\AbstractCommand;

class Upgrade extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('VpsUpgrade')
            ->setDescription('TransIP Vps Upgrades')
            ->setHelp('List possible upgrades for VPS')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getByVpsName")
            ->addUsage("upgrade")
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
                $upgrades = $this->getTransipApi()->vpsUpgrades()->getByVpsName($arguments[0]);
                $this->output($upgrades);
                break;
            case "upgrade":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new Exception("vpsName and ProductName are required");
                }
                $this->getTransipApi()->vpsUpgrades()->upgrade($arguments[0], $arguments[1]);
                break;
            default:
                throw new Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
