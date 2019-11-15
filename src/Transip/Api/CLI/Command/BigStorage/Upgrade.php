<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Upgrade extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';
    const BIGSTORAGE_SIZE = 'size';
    const BIGSTORAGE_HASOFFSITEBACKUPS = 'offSiteBackups';

    protected function configure()
    {
        $this->setName('BigStorage:upgrade')
            ->setDescription('Upgrade your big storage')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'Provide a big storage name')
            ->addArgument(self::BIGSTORAGE_SIZE, InputArgument::REQUIRED, 'The size of the big storage in TB’s, please use a multitude of 2. The maximum size is 40.')
            ->addArgument(self::BIGSTORAGE_HASOFFSITEBACKUPS, InputArgument::OPTIONAL, '(optional) Whether to add offsite backups, default is false.')
            ->setHelp('This command allows you to order a new big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(self::BIGSTORAGE_NAME);
        $bigStorageSize = $input->getArgument(self::BIGSTORAGE_SIZE);

        $hasOffSiteBackupsInput = $input->getArgument(self::BIGSTORAGE_HASOFFSITEBACKUPS);
        $bigStorageHasOffSiteBackups = ($hasOffSiteBackupsInput === null) ? null : filter_var($hasOffSiteBackupsInput, FILTER_VALIDATE_BOOLEAN);

        $this->getTransipApi()->bigStorages()->upgrade($bigStorageName, $bigStorageSize, $bigStorageHasOffSiteBackups);
    }
}
