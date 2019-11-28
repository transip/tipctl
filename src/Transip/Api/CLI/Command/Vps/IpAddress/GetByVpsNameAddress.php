<?php

namespace Transip\Api\CLI\Command\Vps\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsNameAddress extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Vps:IpAddress:getByVpsNameAddress')
            ->setDescription('List information for a specific IP address')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_IPADDRESS, InputArgument::REQUIRED, Field::VPS_IPADDRESS__DESC)
            ->setHelp('This API call returns information (generally network information) based on the specific IP address specified.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $vpsIPAddress = $input->getArgument(Field::VPS_IPADDRESS);

        $ipAddress = $this->getTransipApi()->vpsIpAddresses()->getByVpsNameAddress($vpsName, $vpsIPAddress);
        $this->output($ipAddress);
    }
}
