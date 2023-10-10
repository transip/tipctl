<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Upgrade extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:upgrade')
            ->setDescription('upgrade your big storage')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::BIGSTORAGE_SIZE, InputArgument::REQUIRED, Field::BIGSTORAGE_SIZE__DESC)
            ->addArgument(Field::BIGSTORAGE_HASOFFSITEBACKUPS, InputArgument::OPTIONAL, 'Whether to add offsite backups. (optional)')
            ->setHelp('This command allows you to upgrade a big storage. [deprecated] Use blockstorage:upgrade instead.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:upgrade instead');
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $bigStorageSize = $input->getArgument(Field::BIGSTORAGE_SIZE);

        $hasOffSiteBackupsInput = $input->getArgument(Field::BIGSTORAGE_HASOFFSITEBACKUPS);
        $bigStorageHasOffSiteBackups = ($hasOffSiteBackupsInput === null) ? null : filter_var($hasOffSiteBackupsInput, FILTER_VALIDATE_BOOLEAN);

        $this->getTransipApi()->bigStorages()->upgrade($bigStorageName, $bigStorageSize, $bigStorageHasOffSiteBackups);
        return 0;
    }
}
