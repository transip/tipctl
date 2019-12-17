<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetPtrRecord extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:setPtrRecord')
            ->setDescription('Set the PTR record for your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::IPADDRESS_PTR, InputArgument::REQUIRED, Field::IPADDRESS_PTR__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ptr      = $input->getArgument(Field::IPADDRESS_PTR);
        $haipName = $input->getArgument(Field::HAIP_NAME);

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setPtrRecord($ptr);
        $this->getTransipApi()->haip()->update($haip);
    }
}
