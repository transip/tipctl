<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('PrivateNetwork:getAll')
            ->setDescription('List all private networks in your account.')
            ->setHelp('This command lists all private networks along with the VPSes it’s attached to.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $privateNetworks = $this->getTransipApi()->privateNetworks()->getAll();
        $this->output($privateNetworks);
    }
}
