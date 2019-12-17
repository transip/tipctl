<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetDescription extends AbstractCommand
{
    private const PRIVATENETWORK_DESCRIPTION = 'PrivateNetworkDescription';

    protected function configure(): void
    {
        $this->setName('privateNetwork:setDescription')
            ->setDescription('Set a new description to a private network')
            ->addArgument(Field::PRIVATENETWORK_NAME, InputArgument::REQUIRED, Field::PRIVATENETWORK_NAME__DESC)
            ->addArgument(self::PRIVATENETWORK_DESCRIPTION, InputArgument::REQUIRED, 'The private network description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $privateNetworkName        = $input->getArgument(Field::PRIVATENETWORK_NAME);
        $privateNetworkDescription = $input->getArgument(self::PRIVATENETWORK_DESCRIPTION);

        $privateNetwork = $this->getTransipApi()->privateNetworks()->getByName($privateNetworkName);
        $privateNetwork->setDescription($privateNetworkDescription);

        $this->getTransipApi()->privateNetworks()->update($privateNetwork);
    }
}
