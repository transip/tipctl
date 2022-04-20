<?php

namespace Transip\Api\CLI\Command\OpenStack\User;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:user:create')
            ->setDescription('Create an OpenStack user for one of your projects.')
            ->addArgument(Field::OPENSTACK_PROJECT_ID, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_ID__DESC)
            ->addArgument(Field::OPENSTACK_USER_USERNAME, InputArgument::REQUIRED, Field::OPENSTACK_USER_USERNAME__DESC)
            ->addArgument(Field::OPENSTACK_USER_DESCRIPTION, InputArgument::REQUIRED, Field::OPENSTACK_USER_DESCRIPTION__DESC)
            ->addArgument(Field::OPENSTACK_USER_EMAIL, InputArgument::REQUIRED, Field::OPENSTACK_USER_EMAIL__DESC)
            ->addArgument(Field::OPENSTACK_USER_PASSWORD, InputArgument::REQUIRED, Field::OPENSTACK_USER_PASSWORD__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $projectId   = $input->getArgument(Field::OPENSTACK_PROJECT_ID);
        $username    = $input->getArgument(Field::OPENSTACK_USER_USERNAME);
        $description = $input->getArgument(Field::OPENSTACK_USER_DESCRIPTION);
        $email       = $input->getArgument(Field::OPENSTACK_USER_EMAIL);
        $password    = $input->getArgument(Field::OPENSTACK_USER_PASSWORD);

        $this->getTransipApi()->openStackUsers()->create(
            $username,
            $description,
            $email,
            $password,
            $projectId
        );
        return 0;
    }
}
