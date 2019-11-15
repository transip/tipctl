<?php

namespace Transip\Api\CLI\Command\BigStorage\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;

class GetByBigStorageName extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';

    protected function configure()
    {
        $this->setName('BigStorage:Backup:getByBigStorageName')
            ->setDescription('Get a list of backups for a big storage')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'Name of the big storage')
            ->setHelp('This command lists backups for any given big storage.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(self::BIGSTORAGE_NAME);
        if (strlen($bigStorageName) < 3) {
            throw new Exception('A big storage name is required');
        }
        $vps = $this->getTransipApi()->bigStorageBackups()->getByBigStorageName($bigStorageName);
        $output->writeln(print_r($vps, 1));
    }
}
