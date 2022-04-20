<?php

namespace Transip\Api\CLI\Command\OpenStack\Project\Users;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Revoke extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:project:users:revoke')
            ->setDescription('Revokes a user\'s access to a specific openstack project')
            ->addArgument(Field::OPENSTACK_PROJECT_ID, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_ID__DESC)
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $projectId = $input->getArgument(Field::OPENSTACK_PROJECT_ID);
        $userId = $input->getArgument(Field::OPENSTACK_USER_ID);

        $this->getTransipApi()
            ->openStackProjectUsers()
            ->revokeUserAccessFromProject($projectId, $userId);
        return 0;
    }
}
