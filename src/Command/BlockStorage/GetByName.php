<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:getbyname')
            ->setDescription('Get your block storage by name')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        $blockStorage = $this->getTransipApi()->blockStorages()->getByName($blockStorageName);
        $this->output($blockStorage);
        return 0;
    }
}
