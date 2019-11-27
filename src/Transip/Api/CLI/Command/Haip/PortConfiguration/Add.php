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
        $this->setName('Haip:PortConfiguration:add')
            ->setDescription('Add a new port configuration to your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument('Name', InputArgument::REQUIRED, 'Name of the port configuration')
            ->addArgument('SourcePort', InputArgument::REQUIRED, 'Incoming port number of configuration')
            ->addArgument('TargetPort', InputArgument::REQUIRED, 'Port number to send the traffic to')
            ->addArgument('Mode', InputArgument::REQUIRED, 'The port configuration mode')
            ->addArgument('SslMode', InputArgument::REQUIRED, 'The endpoint SSL mode');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $name = $input->getArgument('Name');
        $sourcePort = $input->getArgument('SourcePort');
        $targetPort = $input->getArgument('TargetPort');
        $mode = $input->getArgument('Mode');
        $sslMode = $input->getArgument('SslMode');

        $portConfiguration = new PortConfiguration();

        $portConfiguration->setName($name);
        $portConfiguration->setSourcePort($sourcePort);
        $portConfiguration->setTargetPort($targetPort);
        $portConfiguration->setMode($mode);
        $portConfiguration->setEndpointSslMode($sslMode);

        $this->getTransipApi()->haipPortConfigurations()->add($haipName, $portConfiguration);
    }
}
