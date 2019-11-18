<?php


namespace Transip\Api\CLI\Command\BigStorage;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class DetachVps extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';

    protected function configure()
    {
        $this->setName('BigStorage:detachVps')
            ->setDescription('Detach your big storage to your vps')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'The name of the big storage.')
            ->setHelp('This command will detach your big storage from your vps.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(self::BIGSTORAGE_NAME);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setVpsName('');

        $this->getTransipApi()->bigStorages()->update($bigStorage);
    }
}
