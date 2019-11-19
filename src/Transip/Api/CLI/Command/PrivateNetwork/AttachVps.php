<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AttachVps extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('PrivateNetwork:attachVps')
            ->setDescription('Attach a VPS to a private network')
            ->addArgument(Field::PRIVATENETWORK_NAlsME, InputArgument::REQUIRED, Field::PRIVATENETWORK_NAME__DESC)
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $privateNetworkName = $input->getArgument(Field::PRIVATENETWORK_NAME);
        $privateNetworkVpsName = $input->getArgument(Field::VPS_NAME);

        $this->getTransipApi()->privateNetworks()->attachVps($privateNetworkName, $privateNetworkVpsName);
    }
}
