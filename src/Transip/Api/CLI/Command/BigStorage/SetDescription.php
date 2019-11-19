<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetDescription extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('BigStorage:setDescription')
            ->setDescription('Update your big storage description')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::BIGSTORAGE_DESCRIPTION, InputArgument::REQUIRED, Field::BIGSTORAGE_DESCRIPTION__DESC)
            ->setHelp('This command will change the description of your big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $bigStorageDescription = $input->getArgument(Field::BIGSTORAGE_DESCRIPTION);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setDescription($bigStorageDescription);

        $this->getTransipApi()->bigStorages()->update($bigStorage);
    }
}
