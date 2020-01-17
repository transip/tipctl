<?php

namespace Transip\Api\CLI\Command\Vps\Firewall;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Enable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:firewall:enable')
            ->setDescription('Enable the VpsFirewall for a specific VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('This will apply the current ruleSet to this VPS. when the ruleSet is empty, all incoming traffic will be blocked');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName  = $input->getArgument(Field::VPS_NAME);
        $firewall = $this->getTransipApi()->vpsFirewall()->getByVpsName($vpsName);
        $firewall->setIsEnabled(true);
        $this->getTransipApi()->vpsFirewall()->update($vpsName, $firewall);
    }
}
