<?php

namespace Transip\Api\CLI\Command\Vps\Firewall;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Vps\FirewallRule;

class RemoveRule extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:firewall:removerule')
            ->setDescription('Remove a rule to the VpsFirewall of a specific VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_FIREWALL_DESCRIPTION, InputArgument::REQUIRED, Field::VPS_FIREWALL_DESCRIPTION__DESC)
            ->addArgument(Field::VPS_FIREWALL_START_PORT, InputArgument::REQUIRED, Field::VPS_FIREWALL_START_PORT__DESC)
            ->addArgument(Field::VPS_FIREWALL_END_PORT, InputArgument::REQUIRED, Field::VPS_FIREWALL_END_PORT__DESC)
            ->addArgument(Field::VPS_FIREWALL_PROTOCOL, InputArgument::REQUIRED, Field::VPS_FIREWALL_PROTOCOL__DESC)
            ->setHelp('Removing a rule will no longer allow matching incoming traffic');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName     = $input->getArgument(Field::VPS_NAME);
        $description = $input->getArgument(Field::VPS_FIREWALL_DESCRIPTION);
        $startPort   = $input->getArgument(Field::VPS_FIREWALL_START_PORT);
        $endPort     = $input->getArgument(Field::VPS_FIREWALL_END_PORT);
        $protocol    = $input->getArgument(Field::VPS_FIREWALL_PROTOCOL);

        $firewallRule = new FirewallRule();
        $firewallRule->setDescription($description);
        $firewallRule->setStartPort($startPort);
        $firewallRule->setEndPort($endPort);
        $firewallRule->setProtocol($protocol);

        $firewall = $this->getTransipApi()->vpsFirewall()->getByVpsName($vpsName);
        $firewall->removeRule($firewallRule);

        $this->getTransipApi()->vpsFirewall()->update($vpsName, $firewall);
        return 0;
    }
}
