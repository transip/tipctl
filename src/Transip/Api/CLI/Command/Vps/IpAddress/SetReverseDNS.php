<?php


namespace Transip\Api\CLI\Command\Vps\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetReverseDNS extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps:IpAddress:setReverseDNS')
            ->setDescription('Update reverse DNS for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_IPAddress, InputArgument::REQUIRED, Field::VPS_IPAddress__DESC)
            ->addArgument(Field::VPS_IPAddress_Ptr, InputArgument::REQUIRED, Field::VPS_IPAddress_Ptr__DESC)
            ->setHelp('Reverse DNS for IPv4 addresses as well as IPv6 addresses can be updated using this command. This command functions if the reverse DNS is not yet configured as well, effectively allowing you to set new reverse DNS for every IP address listed.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $ipAddress = $input->getArgument(Field::VPS_IPAddress);
        $newPointerRecord = $input->getArgument(Field::VPS_IPAddress_Ptr);

        $ipAddressObject = $this->getTransipApi()->vpsIpAddresses()->getByVpsNameAddress($vpsName, $ipAddress);
        $ipAddressObject->setReverseDns($newPointerRecord);
        $this->getTransipApi()->vpsIpAddresses()->update($vpsName, $ipAddressObject);

        $this->output($ipAddressObject);
    }
}
