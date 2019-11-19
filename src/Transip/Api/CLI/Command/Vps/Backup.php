<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\CLI\Command\AbstractCommand;

class Backup extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('VpsBackup')
            ->setDescription('TransIP Vps Backups')
            ->setHelp('Get backups for a VPS, revert or convert them to a snapshot')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getByVpsName")
            ->addUsage("revert")
            ->addUsage("convert")
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
                $vps = $this->getTransipApi()->vpsBackups()->getByVpsName($arguments[0]);
                $this->output($vps);
                break;
            case "revert":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("vpsName and backupId required");
                }
                $this->getTransipApi()->vpsBackups()->revertBackup($arguments[0], $arguments[1]);
                break;
            case "convert":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 3) {
                    throw new \Exception("vpsName,backupId and snapshotDescription required");
                }
                $this->getTransipApi()->vpsBackups()->convertBackupToSnapshot($arguments[0], $arguments[1], '');
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
