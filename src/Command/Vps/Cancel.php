<?php

namespace Transip\Api\CLI\Command\Vps;

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
        $this->setName('vps:cancel')
            ->setDescription('Cancel or terminate a Vps')
            ->setHelp('Provide a Vps name to cancel and a cancellation time (end|immediately)')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::CANCELTIME, InputArgument::REQUIRED, Field::CANCELTIME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName    = $input->getArgument(Field::VPS_NAME);
        $cancelTime = $input->getArgument(Field::CANCELTIME);

        $this->getTransipApi()->vps()->cancel($vpsName, $cancelTime);
    }
}
