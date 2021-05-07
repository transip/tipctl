<?php


namespace Transip\Api\CLI\Command\Vps\Firewall;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Reset extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:firewall:reset')
            ->setDescription('Reset Firewall rules for a VPS to default')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);

        $firewall = $this->getTransipApi()->vpsFirewall()->reset($vpsName);
    }
}
