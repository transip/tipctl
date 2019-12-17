<?php

namespace Transip\Api\CLI\Command\Colocation;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:getall')
            ->setDescription('List all Colocations associated with your TransIP account');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $colocations = $this->getTransipApi()->colocation()->getAll();
        $this->output($colocations);
    }
}
