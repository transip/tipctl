<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetIpSetup extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:setipsetup')
            ->setDescription('Set the IpSetup of your HA-IP, for example don\'t allow ipv6, route ipv6 traffic to ipv4 addresses')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_IP_SETUP, InputArgument::REQUIRED, Field::HAIP_IP_SETUP__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ipSetup  = $input->getArgument(Field::HAIP_IP_SETUP);
        $haipName = $input->getArgument(Field::HAIP_NAME);

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setIpSetup($ipSetup);
        $this->getTransipApi()->haip()->update($haip);
    }
}
