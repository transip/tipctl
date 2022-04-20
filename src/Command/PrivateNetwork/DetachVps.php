<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class DetachVps extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('privatenetwork:detachvps')
            ->setDescription('Remove a VPS from a private network')
            ->addArgument(Field::PRIVATENETWORK_NAME, InputArgument::REQUIRED, Field::PRIVATENETWORK_NAME__DESC)
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $privateNetworkName = $input->getArgument(Field::PRIVATENETWORK_NAME);
        $vpsName            = $input->getArgument(Field::VPS_NAME);

        $this->getTransipApi()->privateNetworks()->detachVps($privateNetworkName, $vpsName);
        return 0;
    }
}
