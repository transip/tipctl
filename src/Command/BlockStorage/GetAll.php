<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:getall')
             ->setDescription('Get all of your block storages');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorages = $this->getTransipApi()->blockStorages()->getAll();
        $this->output($blockStorages);
        return 0;
    }
}
