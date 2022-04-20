<?php

namespace Transip\Api\CLI\Command\OpenStack\User;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:user:getall')
            ->setDescription('List OpenStack users attached to your TransIP account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $projects = $this->getTransipApi()->openStackUsers()->getAll();

        $this->output($projects);
        return 0;
    }
}
