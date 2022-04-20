<?php

namespace Transip\Api\CLI\Command\Vps\OperatingSystem;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:operatingsystem:getall')
            ->setDescription('List installable operating systems for a VPS');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $operatingSystems = $this->getTransipApi()->vpsOperatingSystems()->getAll();
        $this->output($operatingSystems);
        return 0;
    }
}
