<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetAttachedIpAddresses extends AbstractCommand
{
    private const IP_ADDRESSES = 'ipAddresses';

    protected function configure(): void
    {
        $this->setName('Haip:setAttachedIpAddresses')
            ->setDescription('Set the ips to attach to your Haip')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(self::IP_ADDRESSES, InputArgument::REQUIRED, 'IpAddresses ipv4 or/and ipv6 (comma separated)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $ipAddresses = $input->getArgument(self::IP_ADDRESSES);
        $ipAddresses = explode(',', $ipAddresses);

        $this->getTransipApi()->haipIpAddresses()->update($haipName, $ipAddresses);
    }
}
