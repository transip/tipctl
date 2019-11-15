<?php

namespace Transip\Api\CLI\Command\BigStorage\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Revert extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';
    const BIGSTORAGE_BACKUPID = 'backupId';

    protected function configure()
    {
        $this->setName('BigStorage:Backup:revert')
            ->setDescription('Restore a bigstorage backup')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'Name of the big storage')
            ->addArgument(self::BIGSTORAGE_BACKUPID, InputArgument::REQUIRED, 'Id number of the backup')
            ->setHelp('This command restores a big storage backup.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(self::BIGSTORAGE_NAME);
        $bigStorageBackupId = $input->getArgument(self::BIGSTORAGE_BACKUPID);

        $this->getTransipApi()->bigStorageBackups()->revertBackup($bigStorageName, $bigStorageBackupId);
    }
}
