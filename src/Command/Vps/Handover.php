<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Handover extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:handover')
            ->setDescription('Handover a Vps to another TransIP Customer')
            ->setHelp('The Vps will be stopped during the handover')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::CUSTOMER_NAME, InputArgument::REQUIRED, Field::CUSTOMER_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName      = $input->getArgument(Field::VPS_NAME);
        $customerName = $input->getArgument(Field::CUSTOMER_NAME);

        $this->getTransipApi()->vps()->handover($vpsName, $customerName);
        return 0;
    }
}
