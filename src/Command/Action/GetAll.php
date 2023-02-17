<?php

namespace Transip\Api\CLI\Command\Action;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('action:getall')
            ->setDescription('Lists all your actions')
            ->setHelp('This command displays all available zones where you can order a product.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $actions = $this->getTransipApi()->actions()->getAll();
        $this->output($actions);
        return 0;
    }
}
