<?php

namespace Transip\Api\CLI\Command\OpenStack\Project;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:project:getall')
            ->setDescription('List OpenStack projects attached to your TransIP account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $projects = $this->getTransipApi()->openStackProjects()->getAll();

        $this->output($projects);
        return 0;
    }
}
