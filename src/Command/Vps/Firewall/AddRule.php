<?php

namespace Transip\Api\CLI\Command\Vps\Firewall;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Vps\FirewallRule;

class AddRule extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:firewall:addrule')
            ->setDescription('Add a rule to the VpsFirewall of a specific VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_FIREWALL_DESCRIPTION, InputArgument::REQUIRED, Field::VPS_FIREWALL_DESCRIPTION__DESC)
            ->addArgument(Field::VPS_FIREWALL_START_PORT, InputArgument::REQUIRED, Field::VPS_FIREWALL_START_PORT__DESC)
            ->addArgument(Field::VPS_FIREWALL_END_PORT, InputArgument::REQUIRED, Field::VPS_FIREWALL_END_PORT__DESC)
            ->addArgument(Field::VPS_FIREWALL_PROTOCOL, InputArgument::REQUIRED, Field::VPS_FIREWALL_PROTOCOL__DESC)
            ->addArgument(Field::VPS_FIREWALL_WHITELIST, InputArgument::OPTIONAL, Field::VPS_FIREWALL_WHITELIST__DESC . Field::OPTIONAL, [])
            ->setHelp('All incoming traffic that matches this rule will be allowed');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName     = $input->getArgument(Field::VPS_NAME);
        $description = $input->getArgument(Field::VPS_FIREWALL_DESCRIPTION);
        $startPort   = $input->getArgument(Field::VPS_FIREWALL_START_PORT);
        $endPort     = $input->getArgument(Field::VPS_FIREWALL_END_PORT);
        $protocol    = $input->getArgument(Field::VPS_FIREWALL_PROTOCOL);
        $whitelist   = $input->getArgument(Field::VPS_FIREWALL_WHITELIST);

        if (is_string($whitelist)) {
            $whitelist = explode(',', $whitelist);
        }

        $firewallRule = new FirewallRule();
        $firewallRule->setDescription($description);
        $firewallRule->setStartPort($startPort);
        $firewallRule->setEndPort($endPort);
        $firewallRule->setProtocol($protocol);
        $firewallRule->setWhitelist($whitelist);

        $firewall = $this->getTransipApi()->vpsFirewall()->getByVpsName($vpsName);
        $firewall->addRule($firewallRule);

        $this->getTransipApi()->vpsFirewall()->update($vpsName, $firewall);
        return 0;
    }
}
