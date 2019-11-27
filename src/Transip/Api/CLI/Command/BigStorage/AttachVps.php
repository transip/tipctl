<?php


namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AttachVps extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('BigStorage:attachVps')
            ->setDescription('Attach your big storage to your vps')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, 'Name of the vps that the big storage should attach to.')
            ->setHelp('This command will attach your big storage to your vps.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName    = $input->getArgument(Field::BIGSTORAGE_NAME);
        $bigStorageVpsName = $input->getArgument(Field::VPS_NAME);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setVpsName($bigStorageVpsName);

        $this->getTransipApi()->bigStorages()->update($bigStorage);
    }
}
