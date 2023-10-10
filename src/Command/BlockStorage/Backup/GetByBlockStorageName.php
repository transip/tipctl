<?php

namespace Transip\Api\CLI\Command\BlockStorage\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByBlockStorageName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:backup:getbyblockstoragename')
            ->setDescription('Get a list of backups for a block storage')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC)
            ->setHelp('This command lists backups for any given block storage.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        $vps = $this->getTransipApi()->blockStorageBackups()->getByBlockStorageName($blockStorageName);
        $this->output($vps);
        return 0;
    }
}
