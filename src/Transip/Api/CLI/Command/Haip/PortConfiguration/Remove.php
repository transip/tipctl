<?php

namespace Transip\Api\CLI\Command\Haip\PortConfiguration;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Remove extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:portConfiguration:remove')
            ->setDescription('Remove a port configuration for a HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_ID, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName            = $input->getArgument(Field::HAIP_NAME);
        $portConfigurationId = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_ID);

        $this->getTransipApi()->haipPortConfigurations()->delete($haipName, $portConfigurationId);
    }
}
