<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\CLI\Command\AbstractCommand;

class Snapshot extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('VpsSnapshot')
            ->setDescription('TransIP Vps Snapshots')
            ->setHelp('list, create, revert and delete vps snapshots')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getByVpsName")
            ->addUsage("getByVpsNameSnapshotName")
            ->addUsage("create")
            ->addUsage("revert")
            ->addUsage("delete")
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
                $snapshots = $this->getTransipApi()->vpsSnapshots()->getByVpsName($arguments[0]);
                $this->output($snapshots);
                break;
            case "getByVpsNameSnapshotName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and snapshotName is required");
                }
                $snapshot = $this->getTransipApi()->vpsSnapshots()->getByVpsNameSnapshotName($arguments[0], $arguments[1]);
                $this->output($snapshot);
                break;
            case "create":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("vpsName and snapshotDescription are required");
                }
                $this->getTransipApi()->vpsSnapshots()->createSnapshot($arguments[0], $arguments[1]);

                break;
            case "revert":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and snapshotName are required, destinationVpsName is optional");
                }
                $destinationVpsName = $arguments[2] ?? '';
                $this->getTransipApi()->vpsSnapshots()->revertSnapshot($arguments[0], $arguments[1], $destinationVpsName);
                break;
            case "delete":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("VpsName and snapshotName are required");
                }
                $this->getTransipApi()->vpsSnapshots()->deleteSnapshot($arguments[0], $arguments[1]);
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
