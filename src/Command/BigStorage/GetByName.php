<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:getbyname')
            ->setDescription('Get your big storage by name')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->setHelp('This command will return the big storage by name. [deprecated] Use blockstorage:getbyname instead.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:getbyname instead');
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);

        $this->output($bigStorage);
        return 0;
    }
}
