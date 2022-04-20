<?php

namespace Transip\Api\CLI\Command\Haip;

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
        $this->setName('haip:cancel')
            ->setDescription('Cancel HA-IP with cancellation time (end|immediately)')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::CANCELTIME, InputArgument::REQUIRED, Field::CANCELTIME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $haipName   = $input->getArgument(Field::HAIP_NAME);
        $cancelTime = $input->getArgument(Field::CANCELTIME);

        $this->getTransipApi()->haip()->cancel($haipName, $cancelTime);
        return 0;
    }
}
