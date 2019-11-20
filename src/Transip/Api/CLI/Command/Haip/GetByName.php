<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetByName extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Haip:getByName')
            ->setDescription('Get your Haip by name')
            ->addArgument('haipName', InputArgument::REQUIRED, 'name of haip');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument('haipName');
        $haip = $this->getTransipApi()->haip()->getByName($haipName);

        $this->output($haip);
    }
}