<?php

namespace Transip\Api\CLI\Command\Traffic;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Traffic:getByVpsName')
            ->setDescription('Get traffic information for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('This command prints traffic information for a given vps.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        if (strlen($vpsName) < 3) {
            throw new Exception('Vps name is required');
        }

        $traffic = $this->getTransipApi()->traffic()->getByVpsName($vpsName);
        $this->output($traffic);
    }
}
