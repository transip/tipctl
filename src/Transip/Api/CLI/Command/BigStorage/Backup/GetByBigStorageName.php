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
    protected function configure()
    {
        $this->setName('BigStorage:Backup:getByBigStorageName')
            ->setDescription('Get a list of backups for a big storage')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->setHelp('This command lists backups for any given big storage.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        if (strlen($bigStorageName) < 3) {
            throw new Exception('A big storage name is required');
        }
        $vps = $this->getTransipApi()->bigStorageBackups()->getByBigStorageName($bigStorageName);
        $output->writeln(print_r($vps, 1));
    }
}
