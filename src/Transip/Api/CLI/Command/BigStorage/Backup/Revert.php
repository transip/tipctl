<?php

namespace Transip\Api\CLI\Command\BigStorage\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Revert extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('BigStorage:Backup:revert')
            ->setDescription('Restore a bigstorage backup')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::BIGSTORAGE_BACKUPID, InputArgument::REQUIRED, Field::BIGSTORAGE_BACKUPID__DESC)
            ->setHelp('This command restores a big storage backup.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $bigStorageBackupId = $input->getArgument(Field::BIGSTORAGE_BACKUPID);

        $this->getTransipApi()->bigStorageBackups()->revertBackup($bigStorageName, $bigStorageBackupId);
    }
}
