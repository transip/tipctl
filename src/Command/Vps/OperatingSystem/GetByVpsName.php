<?php

namespace Transip\Api\CLI\Command\Vps\OperatingSystem;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:operatingsystem:getbyvpsname')
            ->setDescription('List operating systems with specific licences quantities and pricing for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $operatingSystems = $this->getTransipApi()->vpsOperatingSystems()->getByVpsName($vpsName);
        $this->output($operatingSystems);
    }
}
