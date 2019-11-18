<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Domain:getAll')
            ->setDescription('Get all of your Domains');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domains = $this->getTransipApi()->domains()->getAll();
        $output->writeln(print_r($domains,1));
    }
}