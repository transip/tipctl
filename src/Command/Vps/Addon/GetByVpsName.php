<?php


namespace Transip\Api\CLI\Command\Vps\Addon;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:addon:getbyvpsname')
            ->setDescription('List active, cancellable and available addons for a VPS.')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('List active, cancellable and available addons for a VPS.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $vps = $this->getTransipApi()->vpsAddons()->getByVpsName($vpsName);

        $this->output($vps);
        return 0;
    }
}
