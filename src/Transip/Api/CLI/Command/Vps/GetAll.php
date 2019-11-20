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
            ->setDescription('List all VPSs associated with your TransIP account');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpses = $this->getTransipApi()->vps()->getAll();

        $this->output($vpses);
    }
}
