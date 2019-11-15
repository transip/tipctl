<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;
use Transip\Api\Client\Exception\HttpRequest\NotFoundException;

class GetByName extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('BigStorage:getByName')
            ->setDescription('Get your big storage by name')
            ->addArgument("BigStorageName", InputArgument::REQUIRED, "Provide a big storage name");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('BigStorageName');
        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($arguments[0]);

        $output->writeln(print_r($bigStorage, 1));
    }
}
