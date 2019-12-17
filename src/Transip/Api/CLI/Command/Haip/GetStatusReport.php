<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetStatusReport extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('haip:getstatusreport')
            ->setDescription('Get the current status of your Haip and its backends')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);

        $statusOutput = $this->getTransipApi()->haipStatusReports()->getByHaipName($haipName);

        $this->output($statusOutput);
    }
}
