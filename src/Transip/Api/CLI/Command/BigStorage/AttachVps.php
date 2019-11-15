<?php


namespace Transip\Api\CLI\Command\BigStorage;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class AttachVps extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';
    const BIGSTORAGE_VPSNAME = 'vpsName';

    protected function configure()
    {
        $this->setName('BigStorage:attachVps')
            ->setDescription('Attach your big storage to your vps')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'The name of the big storage.')
            ->addArgument(self::BIGSTORAGE_VPSNAME, InputArgument::REQUIRED, 'Name of the vps that the big storage should attach to.')
            ->setHelp('This command will attach your big storage to your vps.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName    = $input->getArgument(self::BIGSTORAGE_NAME);
        $bigStorageVpsName = $input->getArgument(self::BIGSTORAGE_VPSNAME);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setVpsName($bigStorageVpsName);

        $this->getTransipApi()->bigStorages()->update($bigStorage);
    }
}
