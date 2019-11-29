<?php

namespace Transip\Api\CLI\Command\Colocation;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Colocation:getByName')
            ->setDescription('Get your colocation by name')
            ->setHelp('Provide a name to retrieve your colocation')
            ->addArgument(Field::COLOCATION_NAME, InputArgument::REQUIRED, Field::COLOCATION_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coloName = $input->getArgument(Field::COLOCATION_NAME);
        $colo     = $this->getTransipApi()->colocation()->getByName($coloName);
        $this->output($colo);
    }
}
