<?php

namespace Transip\Api\CLI\Command\OpenStack\User;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetPassword extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:user:setpassword')
            ->setDescription('Updates an OpenStack user\'s password.')
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
            ->addArgument(Field::OPENSTACK_USER_PASSWORD, InputArgument::REQUIRED, Field::OPENSTACK_USER_PASSWORD__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId   = $input->getArgument(Field::OPENSTACK_USER_ID);
        $password = $input->getArgument(Field::OPENSTACK_USER_PASSWORD);

        $this->getTransipApi()->openStackUsers()->updatePassword($userId, $password);
        return 0;
    }
}
