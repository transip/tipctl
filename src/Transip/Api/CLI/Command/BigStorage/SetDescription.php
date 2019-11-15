<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class SetDescription extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';
    const BIGSTORAGE_DESCRIPTION = 'description';

    protected function configure()
    {
        $this->setName('BigStorage:setDescription')
            ->setDescription('Update your big storage description')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'Name of the big storage')
            ->addArgument(self::BIGSTORAGE_DESCRIPTION, InputArgument::REQUIRED, 'Description of the big storage')
            ->setHelp('This command will change the description of your big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(self::BIGSTORAGE_NAME);
        $bigStorageDescription = $input->getArgument(self::BIGSTORAGE_DESCRIPTION);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setDescription($bigStorageDescription);

        $this->getTransipApi()->bigStorages()->update($bigStorage);
    }
}
