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
            ->setDescription('Get all of your HA-IP\'s');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $haips = $this->getTransipApi()->haip()->getAll();

        $this->output($haips);
        return 0;
    }
}
