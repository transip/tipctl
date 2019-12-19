<?php

namespace Transip\Api\CLI\Command\Colocation\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Add extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:ipaddress:add')
            ->setDescription('Allocate ipAddresses that are in a range that belong to your colocation')
            ->addArgument(Field::COLOCATION_NAME, InputArgument::REQUIRED, Field::COLOCATION_NAME__DESC)
            ->addArgument(Field::IPADDRESS, InputArgument::REQUIRED, Field::IPADDRESS__DESC)
            ->addArgument(Field::IPADDRESS_PTR, InputArgument::OPTIONAL, Field::IPADDRESS_PTR__DESC, '')
            ->setHelp('add ipAddress from a range so a ReverseDNS can be set');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coloName = $input->getArgument(Field::COLOCATION_NAME);
        $ipAddress = $input->getArgument(Field::IPADDRESS);
        $ptr = $input->getArgument(Field::IPADDRESS_PTR);
        $this->getTransipApi()->colocationIpAddress()->addIpAddress($coloName, $ipAddress, $ptr);
    }
}
