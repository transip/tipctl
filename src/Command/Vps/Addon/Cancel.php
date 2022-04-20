<?php

namespace Transip\Api\CLI\Command\Vps\Addon;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Cancel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:addon:cancel')
            ->setDescription('Cancel an add-on based on its name')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_ADDON, InputArgument::REQUIRED, Field::VPS_ADDON__DESC)
            ->setHelp('Cancel an add-on based on its name, specifying the VPS name as well. This will instantly cancel the given add-on');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $addonName = $input->getArgument(Field::VPS_ADDON);

        $this->getTransipApi()->vpsAddons()->cancel($vpsName, $addonName);
        return 0;
    }
}
