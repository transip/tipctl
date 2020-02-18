<?php


namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class DetachVps extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:detachvps')
            ->setDescription('Detach your big storage to your vps')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->setHelp('This command will detach your big storage from your vps.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setVpsName('');

        $this->getTransipApi()->bigStorages()->update($bigStorage);
    }
}
