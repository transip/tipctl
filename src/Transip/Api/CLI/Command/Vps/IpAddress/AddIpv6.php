<?php


namespace Transip\Api\CLI\Command\Vps\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AddIpv6 extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps:IpAddress:addIpv6')
            ->setDescription('Add an IPv6 address to a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_IPV6Address, InputArgument::REQUIRED, Field::VPS_IPV6Address__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $IPv6Address = $input->getArgument(Field::VPS_IPV6Address);

        $this->getTransipApi()->vpsIpAddresses()->addIpv6Address($vpsName, $IPv6Address);
    }
}
