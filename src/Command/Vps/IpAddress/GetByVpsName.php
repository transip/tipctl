<?php

namespace Transip\Api\CLI\Command\Vps\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:ipaddress:getbyvpsname')
            ->setDescription('List IP addresses for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('This API call will return all IPv4 and IPv6 addresses attached to the VPS');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName     = $input->getArgument(Field::VPS_NAME);
        $ipAddresses = $this->getTransipApi()->vpsIpAddresses()->getByVpsName($vpsName);

        $this->output($ipAddresses);
    }
}
