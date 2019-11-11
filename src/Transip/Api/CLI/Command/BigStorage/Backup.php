<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\CLI\Command\AbstractCommand;

class Backup extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('BigStorageBackup')
            ->setDescription('TransIP BigStorage Backups')
            ->setHelp('Get or revert backups for a BigStorage')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getByBigStorageName")
            ->addUsage("revert")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getByBigStorageName":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("BigStorageName is required");
                }
                $vps = $this->getTransipApi()->bigStorageBackups()->getByBigStorageName($arguments[0]);
                $output->writeln(print_r($vps, 1));
                break;
            case "revert":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new \Exception("BigStorageName and backupId required");
                }
                $this->getTransipApi()->bigStorageBackups()->revertBackup($arguments[0], $arguments[1]);
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
