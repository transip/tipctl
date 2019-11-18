<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetByName extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';

    protected function configure()
    {
        $this->setName('BigStorage:getByName')
            ->setDescription('Get your big storage by name')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'Name of the big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(self::BIGSTORAGE_NAME);
        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);

        $output->writeln(print_r($bigStorage, 1));
    }
}
