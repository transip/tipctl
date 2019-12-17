<?php

namespace Transip\Api\CLI\Command\Haip\PortConfiguration;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Client\Entity\Haip\PortConfiguration;

class Add extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:portConfiguration:add')
            ->setDescription('Add a new port configuration to your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_NAME, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_NAME__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_SOURCE_PORT, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_SOURCE_PORT__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_TARGET_PORT, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_TARGET_PORT__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_MODE, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_MODE__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_SSL_MODE, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_SSL_MODE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName   = $input->getArgument(Field::HAIP_NAME);
        $name       = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_NAME);
        $sourcePort = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_SOURCE_PORT);
        $targetPort = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_TARGET_PORT);
        $mode       = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_MODE);
        $sslMode    = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_SSL_MODE);

        $portConfiguration = new PortConfiguration();

        $portConfiguration->setName($name);
        $portConfiguration->setSourcePort($sourcePort);
        $portConfiguration->setTargetPort($targetPort);
        $portConfiguration->setMode($mode);
        $portConfiguration->setEndpointSslMode($sslMode);

        $this->getTransipApi()->haipPortConfigurations()->add($haipName, $portConfiguration);
    }
}
