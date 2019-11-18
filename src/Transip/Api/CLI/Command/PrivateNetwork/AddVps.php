<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AddVps extends AbstractPrivateNetwork
{

    protected function configure()
    {
        $this->setName('PrivateNetwork:addVps')
            ->setDescription('Attach a VPS to a private network')
            ->addArgument(Field::PRIVATENETWORK_NAME, InputArgument::REQUIRED, Field::PRIVATENETWORK_NAME__DESC)
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $privateNetworkName = $input->getArgument(self::PRIVATENETWORK_NAME);
        $privateNetworkVpsName = $input->getArgument(self::PRIVATENETWORK_VPSNAME);

        $this->getTransipApi()->privateNetworks()->addVps($privateNetworkName, $privateNetworkVpsName);
    }
}
