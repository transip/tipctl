<?php


namespace Transip\Api\CLI\Command\Vps\Upgrade;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:upgrade:getbyvpsname')
            ->setDescription('List available upgrades for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);

        $upgrades = $this->getTransipApi()->vpsUpgrades()->getByVpsName($vpsName);
        $this->output($upgrades);
        return 0;
    }
}
