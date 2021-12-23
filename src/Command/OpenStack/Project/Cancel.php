<?php

namespace Transip\Api\CLI\Command\OpenStack\Project;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Cancel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:project:cancel')
            ->setDescription('Cancel and delete an OpenStack project.')
            ->addArgument(Field::OPENSTACK_PROJECT_ID, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_ID__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projectId = $input->getArgument(Field::OPENSTACK_PROJECT_ID);

        $this->getTransipApi()->openStackProjects()->cancel($projectId);
    }
}
