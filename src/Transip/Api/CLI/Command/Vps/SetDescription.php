<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetDescription extends AbstractCommand
{
    private const VPS_DESCRIPTION = 'VpsDescription';

    protected function configure(): void
    {
        $this->setName('Vps:setDescription')
            ->setDescription('Set the description of a Vps')
            ->setHelp('Provide a Vps name and a description name')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(self::VPS_DESCRIPTION, InputArgument::REQUIRED, 'The vps description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $vpsDescription = $input->getArgument(self::VPS_DESCRIPTION);

        $vps = $this->getTransipApi()->vps()->getByName($vpsName);
        $vps->setDescription($vpsDescription);
        $this->getTransipApi()->vps()->update($vps);

        $this->output($vps);
    }
}
