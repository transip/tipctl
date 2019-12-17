<?php

namespace Transip\Api\CLI\Command\Colocation\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class UpdatePtr extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:ipAddress:updatePtr')
            ->setDescription('Update the ReverseDNS of a IpAddress')
            ->addArgument(Field::COLOCATION_NAME, InputArgument::REQUIRED, Field::COLOCATION_NAME__DESC)
            ->addArgument(Field::IPADDRESS, InputArgument::REQUIRED, Field::IPADDRESS__DESC)
            ->addArgument(Field::IPADDRESS_PTR, InputArgument::OPTIONAL, Field::IPADDRESS_PTR__DESC, '')
            ->setHelp('Set the reverseDNS ptr record for given ipAddress');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coloName  = $input->getArgument(Field::COLOCATION_NAME);
        $ipAddress = $input->getArgument(Field::IPADDRESS);
        $ptr       = $input->getArgument(Field::IPADDRESS_PTR);

        $ipAddress = $this->getTransipApi()->colocationIpAddress()->getByColoNameAddress($coloName, $ipAddress);
        $ipAddress->setReverseDns($ptr);
        $this->getTransipApi()->colocationIpAddress()->update($coloName, $ipAddress);

        $this->output($ipAddress);
    }
}
