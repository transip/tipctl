<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetLoadBalancingMode extends AbstractCommand
{
    private const LOADBALANCING_MODE = 'LoadBalancingMode';
    private const COOKIE_NAME = 'CookieName';

    protected function configure(): void
    {
        $this->setName('Haip:setLoadBalancingMode')
            ->setDescription('Set the load balancing mode and optional cookie mode on HTTP balancing of the Haip')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(self::LOADBALANCING_MODE, InputArgument::REQUIRED, 'the load balancing mode for the haip (roundrobin|cookie|source) are allowed load balancing modes')
            ->addArgument(self::COOKIE_NAME, InputArgument::OPTIONAL, 'on load balancing mode cookie you should provide a cookie name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $balancingMode = $input->getArgument(self::LOADBALANCING_MODE);
        $cookieName = $input->getArgument(self::COOKIE_NAME);

        if ($balancingMode == 'cookie' && $cookieName == null) {
            throw new \Exception("No sticky cookie name provided while load balancing mode is set to 'cookie'");
        }

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setLoadBalancingMode($balancingMode);
        if ($cookieName) {
            $haip->setStickyCookieName($cookieName);
        }

        $this->getTransipApi()->haip()->update($haip);
    }
}
