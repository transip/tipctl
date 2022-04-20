<?php

namespace Transip\Api\CLI\Command\Vps\Firewall;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Disable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:firewall:disable')
            ->setDescription('Disable the VpsFirewall for a specific VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('All incoming traffic will be allowed when VpsFirewall is disabled');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName  = $input->getArgument(Field::VPS_NAME);
        $firewall = $this->getTransipApi()->vpsFirewall()->getByVpsName($vpsName);
        $firewall->setIsEnabled(false);
        $this->getTransipApi()->vpsFirewall()->update($vpsName, $firewall);
        return 0;
    }
}
