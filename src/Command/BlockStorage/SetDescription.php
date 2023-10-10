<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetDescription extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:setdescription')
            ->setDescription('Update your block storage description')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC)
            ->addArgument(Field::BLOCKSTORAGE_DESCRIPTION, InputArgument::REQUIRED, Field::BLOCKSTORAGE_DESCRIPTION__DESC)
            ->setHelp('This command will change the description of your block storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        $blockStorageDescription = $input->getArgument(Field::BLOCKSTORAGE_DESCRIPTION);

        $blockStorage = $this->getTransipApi()->blockStorages()->getByName($blockStorageName);
        $blockStorage->setDescription($blockStorageDescription);

        $this->getTransipApi()->blockStorages()->update($blockStorage);
        return 0;
    }
}
