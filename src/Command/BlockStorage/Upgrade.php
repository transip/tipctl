<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Upgrade extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:upgrade')
            ->setDescription('upgrade your block storage')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC)
            ->addArgument(Field::BLOCKSTORAGE_SIZE, InputArgument::REQUIRED, Field::BLOCKSTORAGE_SIZE__DESC)
            ->addArgument(Field::BLOCKSTORAGE_HASOFFSITEBACKUPS, InputArgument::OPTIONAL, 'Whether to add offsite backups. (optional)')
            ->setHelp('This command allows you to upgrade a block storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        $blockStorageSize = $input->getArgument(Field::BLOCKSTORAGE_SIZE);

        $hasOffSiteBackupsInput = $input->getArgument(Field::BLOCKSTORAGE_HASOFFSITEBACKUPS);
        $blockStorageHasOffSiteBackups = ($hasOffSiteBackupsInput === null) ? null : filter_var($hasOffSiteBackupsInput, FILTER_VALIDATE_BOOLEAN);

        $this->getTransipApi()->blockStorages()->upgrade($blockStorageName, $blockStorageSize, $blockStorageHasOffSiteBackups);
        return 0;
    }
}
