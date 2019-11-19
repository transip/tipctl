<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps:getAll')
            ->setDescription('Get all of your Vpses');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpses = $this->getTransipApi()->vps()->getAll();

        $this->output($vpses);
    }
}
