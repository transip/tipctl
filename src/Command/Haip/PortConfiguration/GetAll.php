<?php

namespace Transip\Api\CLI\Command\Haip\PortConfiguration;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:portconfiguration:getall')
            ->setDescription('Get all of your HA-IP port configurations')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);

        $portConfigurations = $this->getTransipApi()->haipPortConfigurations()->getByHaipName($haipName);

        $this->output($portConfigurations);
        return 0;
    }
}
