<?php


namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('BigStorage:getAll')
             ->setDescription('Get all of your big storages');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorages = $this->getTransipApi()->bigStorages()->getAll();

        $output->writeln(print_r($bigStorages, 1));
    }
}
