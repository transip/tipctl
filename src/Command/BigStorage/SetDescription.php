<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetDescription extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:setdescription')
            ->setDescription('Update your big storage description')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::BIGSTORAGE_DESCRIPTION, InputArgument::REQUIRED, Field::BIGSTORAGE_DESCRIPTION__DESC)
            ->setHelp('This command will change the description of your big storage. [deprecated] Use blockstorage:setdescription instead.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:setdescription instead');
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $bigStorageDescription = $input->getArgument(Field::BIGSTORAGE_DESCRIPTION);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setDescription($bigStorageDescription);

        $this->getTransipApi()->bigStorages()->update($bigStorage);
        return 0;
    }
}
