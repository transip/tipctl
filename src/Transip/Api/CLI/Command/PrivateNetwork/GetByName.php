<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;
use Transip\Api\CLI\Command\Field;

class GetByName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('privateNetwork:getByName')
            ->setDescription('Gather detailed information about a private network.')
            ->addArgument(Field::PRIVATENETWORK_NAME, InputArgument::REQUIRED, Field::PRIVATENETWORK_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $privateNetworkName = $input->getArgument(Field::PRIVATENETWORK_NAME);
        $privateNetwork     = $this->getTransipApi()->privateNetworks()->getByName($privateNetworkName);

        $this->output($privateNetwork);
    }
}
