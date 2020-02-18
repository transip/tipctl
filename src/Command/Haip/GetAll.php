<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:getall')
            ->setDescription('Get all of your Haips');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haips = $this->getTransipApi()->haip()->getAll();

        $this->output($haips);
    }
}
