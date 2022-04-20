<?php

namespace Transip\Api\CLI\Command\Vps\License;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Order extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:license:order')
            ->setDescription('Purchase an addon license for your VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::LICENSE_NAME, InputArgument::REQUIRED, Field::LICENSE_NAME__DESC)
            ->addArgument(Field::QUANTITY, InputArgument::OPTIONAL, Field::QUANTITY__DESC, 1);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName     = $input->getArgument(Field::VPS_NAME);
        $licenseName = $input->getArgument(Field::LICENSE_NAME);
        $quantity    = $input->getArgument(Field::QUANTITY);

        $this->getTransipApi()->vpsLicenses()->order(
            $vpsName,
            $licenseName,
            $quantity
        );
        return 0;
    }
}
