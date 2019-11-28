<?php

namespace Transip\Api\CLI\Command\Vps\Addon;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Order extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Vps:Addon:order')
            ->setDescription('Extend a specific VPS with add-ons')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_ADDONS, InputArgument::REQUIRED, Field::VPS_ADDONS__DESC)
            ->setHelp('Extend a specific VPS with add-ons. The type of add-ons that can be ordered range from extra IP addresses to hardware add-ons such as an extra core or additional SSD disk space');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $addons  = $input->getArgument(Field::VPS_ADDONS);

        $addons = explode(',', $addons);

        $this->getTransipApi()->vpsAddons()->order(
            $vpsName,
            $addons
        );
    }
}
