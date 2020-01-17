<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetHealthCheckInterval extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:sethealthcheckinterval')
            ->setDescription('Set the interval in milliseconds on which the health check runs')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_INTERVAL, InputArgument::REQUIRED, Field::HAIP_INTERVAL__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $interval = intval($input->getArgument(Field::HAIP_INTERVAL));

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setHealthCheckInterval($interval);

        $this->getTransipApi()->haip()->update($haip);
    }
}
