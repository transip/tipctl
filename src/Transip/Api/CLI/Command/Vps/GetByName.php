<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetByName extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Vps:getByName')
            ->setDescription('Get your Vps by name')
            ->setHelp('Provide a name to retrieve your Vps by name')
            ->addArgument('VpsName', InputArgument::REQUIRED, 'VpsName');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument('VpsName');
        $vps = $this->getTransipApi()->vps()->getByName($vpsName);
        $output->writeln(print_r($vps,1));
    }
}
