<?php

namespace Transip\Api\CLI\Command\Vps\Upgrade;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Upgrade extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Vps:Upgrade:upgrade')
            ->setDescription('Upgrading a VPS by specifying the upgrade name.')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_PRODUCT_NAME, InputArgument::REQUIRED, Field::VPS_PRODUCT_NAME__DESC)
            ->setHelp(
                'It’s not possible to downgrade a VPS, as most upgrades cannot be deallocated due to technical reasons (data loss when shrinking the disk space).'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $productName = $input->getArgument(Field::VPS_PRODUCT_NAME);
        $this->getTransipApi()->vpsUpgrades()->upgrade($vpsName, $productName);
    }
}
