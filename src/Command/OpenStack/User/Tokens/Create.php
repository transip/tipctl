<?php

namespace Transip\Api\CLI\Command\OpenStack\User\Tokens;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:users:token:create')
            ->setDescription('Create an OpenStack S3 token for one of your users')
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
            ->addArgument(Field::OPENSTACK_PROJECT_ID, InputArgument::REQUIRED, Field::OPENSTACK_PROJECT_ID__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId      = $input->getArgument(Field::OPENSTACK_USER_ID);
        $projectId   = $input->getArgument(Field::OPENSTACK_PROJECT_ID);

        $this->getTransipApi()->openStackTokens()->create(
            $userId,
            $projectId
        );
        return 0;
    }
}
