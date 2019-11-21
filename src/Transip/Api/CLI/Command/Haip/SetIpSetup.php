<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetIpSetup extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Haip:setIpSetup')
            ->setDescription('Set the IpSetup of your HA-IP, for example don\'t allow ipv6, route ipv6 traffic to ipv4 addresses')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument('IpSetup', InputArgument::REQUIRED, 'HA-IP IP setup can be any of (both, noipv6, ipv6to4)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ipSetup = $input->getArgument('IpSetup');
        $haipName = $input->getArgument(Field::HAIP_NAME);

        if (!in_array($ipSetup, ['both', 'noipv6', 'ipv6to4'])) {
            throw new \Exception("invalid ipSetup, examples: (both, noipv6, ipv6to4)");
        }

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setIpSetup($ipSetup);
        $this->getTransipApi()->haip()->update($haip);
    }
}
