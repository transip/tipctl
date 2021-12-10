<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Haip;

class SetLoadBalancingMode extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:setloadbalancingmode')
            ->setDescription('Set the load balancing mode and optional cookie mode on HTTP balancing of the HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_LOADBALANCING_MODE, InputArgument::REQUIRED, Field::HAIP_LOADBALANCING_MODE__DESC)
            ->addArgument(Field::HAIP_COOKIE_NAME, InputArgument::OPTIONAL, Field::HAIP_COOKIE_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName      = $input->getArgument(Field::HAIP_NAME);
        $balancingMode = $input->getArgument(Field::HAIP_LOADBALANCING_MODE);
        $cookieName    = $input->getArgument(Field::HAIP_COOKIE_NAME);

        if ($balancingMode == Haip::BALANCINGMODE_COOKIE && $cookieName == null) {
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
