<?php

namespace Transip\Api\CLI\Command\Vps\Setting;

use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('vps:setting:getbyvpsname')
            ->setDescription('List all settings for a specified VPS')
            ->setHelp('Provide a VPS name to retrieve all settings for that VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName   = $input->getArgument(Field::VPS_NAME);
        $settings  = $this->getTransipApi()->vpsSettings()->getByVpsName($vpsName);
        $this->output($settings);
        return 0;
    }
}
