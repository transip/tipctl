<?php


namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:getall')
             ->setDescription('Get all of your big storages')
             ->setHelp('This command will return all your big storages. [deprecated] Use blockstorage:getall instead.');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:getall instead');
        $bigStorages = $this->getTransipApi()->bigStorages()->getAll();

        $this->output($bigStorages);
        return 0;
    }
}
