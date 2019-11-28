<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Exception;

class Cancel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('PrivateNetwork:cancel')
            ->setDescription('Terminate or cancel your private network')
            ->addArgument(Field::PRIVATENETWORK_NAME, InputArgument::REQUIRED, Field::PRIVATENETWORK_NAME__DESC)
            ->addArgument(Field::CANCELTIME, InputArgument::REQUIRED, Field::CANCELTIME__DESC)
            ->setHelp('This command will terminate or cancel your private network.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $privateNetworkName = $input->getArgument(Field::PRIVATENETWORK_NAME);

        $cancelTime = $input->getArgument(Field::CANCELTIME);
        if (!in_array($cancelTime, ['end', 'immediately'])) {
            throw new Exception("Incorrect cancellation time provided, the value can only be 'end' or 'immediately'.");
        }
        $this->getTransipApi()->privateNetworks()->cancel($privateNetworkName, $cancelTime);
    }
}
