<?php

namespace Transip\Api\CLI\Command\Haip\PortConfiguration;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Haip\PortConfiguration;

class Change extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:portconfiguration:change')
            ->setDescription('Update a port configuration for your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_ID, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_ID__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_NAME, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_NAME__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_SOURCE_PORT, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_SOURCE_PORT__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_TARGET_PORT, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_TARGET_PORT__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_MODE, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_MODE__DESC)
            ->addArgument(Field::HAIP_PORT_CONFIGURATION_SSL_MODE, InputArgument::REQUIRED, Field::HAIP_PORT_CONFIGURATION_SSL_MODE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $haipName            = $input->getArgument(Field::HAIP_NAME);
        $portConfigurationId = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_ID);
        $name                = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_NAME);
        $sourcePort          = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_SOURCE_PORT);
        $targetPort          = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_TARGET_PORT);
        $mode                = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_MODE);
        $sslMode             = $input->getArgument(Field::HAIP_PORT_CONFIGURATION_SSL_MODE);

        $portConfiguration = $this->getTransipApi()->haipPortConfigurations()->getByPortConfigurationId($haipName, $portConfigurationId);

        $portConfiguration->setName($name);
        $portConfiguration->setSourcePort($sourcePort);
        $portConfiguration->setTargetPort($targetPort);
        $portConfiguration->setMode($mode);
        $portConfiguration->setEndpointSslMode($sslMode);

        $this->getTransipApi()->haipPortConfigurations()->update($haipName, $portConfiguration);
        return 0;
    }
}
