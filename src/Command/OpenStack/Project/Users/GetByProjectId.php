<?php

namespace Transip\Api\CLI\Command\OpenStack\Project\Users;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByProjectId extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:project:users:getbyprojectid')
            ->setDescription('Get the users for a specific openstack project')
            ->addArgument(Field::OPENSTACK_PROJECT_ID, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_ID__DESC)
            ->setHelp('This API call returns details for each user assigned to a project');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $projectId = $input->getArgument(Field::OPENSTACK_PROJECT_ID);

        $usersData = $this->getTransipApi()
            ->openStackProjectUsers()
            ->getByProjectId($projectId);

        $this->output($usersData);
        return 0;
    }
}
