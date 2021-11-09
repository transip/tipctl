<?php

namespace Transip\Api\CLI\Command\OpenStack\Project;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:project:update')
            ->setDescription('Update an OpenStack project.')
            ->addArgument(Field::OPENSTACK_PROJECT_ID, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_ID__DESC)
            ->addArgument(Field::OPENSTACK_PROJECT_NAME, InputArgument::OPTIONAL, Field::OPENSTACK_PROJECT_NAME__DESC)
            ->addArgument(Field::OPENSTACK_PROJECT_DESCRIPTION, InputArgument::OPTIONAL, Field::OPENSTACK_PROJECT_DESCRIPTION__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projectId   = $input->getArgument(Field::OPENSTACK_PROJECT_ID);
        $name        = $input->getArgument(Field::OPENSTACK_PROJECT_NAME);
        $description = $input->getArgument(Field::OPENSTACK_PROJECT_DESCRIPTION);

        if ($description === null && $name === null) {
            $output->writeln(
                'Nothing to update, please provide either a new project name, a project description or both'
            );
            return;
        }

        $project = $this->getTransipApi()->openStackProjects()->getByProjectId($projectId);

        $project->setName($name ?? $project->getName());
        $project->setDescription($description ?? $project->getDescription());

        $this->getTransipApi()->openStackProjects()->updateProject($project);
    }
}
