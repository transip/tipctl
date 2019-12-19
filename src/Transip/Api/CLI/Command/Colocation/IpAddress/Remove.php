<?php

namespace Transip\Api\CLI\Command\Colocation\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Remove extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:ipaddress:remove')
            ->setDescription('Administratively remove ipAddresses that are in a range that belong to your colocation')
            ->addArgument(Field::COLOCATION_NAME, InputArgument::REQUIRED, Field::COLOCATION_NAME__DESC)
            ->addArgument(Field::IPADDRESS, InputArgument::REQUIRED, Field::IPADDRESS__DESC)
            ->setHelp('Administratively remove a ipAddress from a range');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coloName = $input->getArgument(Field::COLOCATION_NAME);
        $ipAddress = $input->getArgument(Field::IPADDRESS);
        $this->getTransipApi()->colocationIpAddress()->removeAddress($coloName, $ipAddress);
    }
}
