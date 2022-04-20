<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:getbyname')
            ->setDescription('Get HA-IP by name')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $haip     = $this->getTransipApi()->haip()->getByName($haipName);

        $this->output($haip);
        return 0;
    }
}
