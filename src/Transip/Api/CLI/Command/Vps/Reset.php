<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Reset extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:reset')
            ->setDescription('Reset a Vps')
            ->setHelp('Provide a Vps name to reset')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);

        $this->getTransipApi()->vps()->reset($vpsName);
    }
}
