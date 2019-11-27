<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetHealthCheckInterval extends AbstractCommand
{
    private const INTERVAL = 'interval';

    protected function configure(): void
    {
        $this->setName('Haip:setHealthCheckInterval')
            ->setDescription('Set the interval in milliseconds on which the health check runs')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(self::INTERVAL, InputArgument::REQUIRED, 'the interval must be larger than 2000');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $interval = intval($input->getArgument(self::INTERVAL));

        if ($interval < 2000) {
            throw new \Exception("Health check interval must be larger than 2000");
        }

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setHealthCheckInterval($interval);

        $this->getTransipApi()->haip()->update($haip);
    }
}
