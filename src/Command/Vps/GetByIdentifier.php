<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByIdentifier extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:getbyidentifier')
            ->setDescription('Get your Vps by identifier (name or uuid)')
            ->setHelp('Provide a name or uuid to retrieve your Vps by identifier')
            ->addArgument(Field::VPS_IDENTIFIER, InputArgument::REQUIRED, Field::VPS_IDENTIFIER__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsIdentifier = $input->getArgument(Field::VPS_IDENTIFIER);
        $vps           = $this->getTransipApi()->vps()->getByIdentifier($vpsIdentifier);
        $this->output($vps);
        return 0;
    }
}
