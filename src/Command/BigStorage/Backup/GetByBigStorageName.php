<?php

namespace Transip\Api\CLI\Command\BigStorage\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;
use Transip\Api\CLI\Command\Field;

class GetByBigStorageName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:backup:getbybigstoragename')
            ->setDescription('Get a list of backups for a big storage')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->setHelp('This command lists backups for any given big storage. [deprecated] Use blockstorage:backup:getbyblockstoragename instead.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:backup:getbyblockstoragename instead');
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $vps = $this->getTransipApi()->bigStorageBackups()->getByBigStorageName($bigStorageName);
        $this->output($vps);
        return 0;
    }
}
