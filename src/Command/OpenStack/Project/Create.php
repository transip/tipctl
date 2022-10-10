<?php

namespace Transip\Api\CLI\Command\OpenStack\Project;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:project:create')
            ->setDescription('Create an OpenStack project.')
            ->addArgument(Field::OPENSTACK_PROJECT_NAME, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_NAME__DESC)
            ->addArgument(Field::OPENSTACK_PROJECT_DESCRIPTION, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_DESCRIPTION__DESC)
            ->addArgument(Field::OPENSTACK_PROJECT_TYPE, InputArgument::OPTIONAL, Field::OPENSTACK_PROJECT_TYPE__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name        = $input->getArgument(Field::OPENSTACK_PROJECT_NAME);
        $description = $input->getArgument(Field::OPENSTACK_PROJECT_DESCRIPTION);
        $type        = $input->getArgument(Field::OPENSTACK_PROJECT_TYPE) ?? 'openstack';

        $this->getTransipApi()->openStackProjects()->create(
            $name,
            $description,
            $type
        );

        return 0;
    }
}
