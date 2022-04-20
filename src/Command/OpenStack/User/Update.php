<?php

namespace Transip\Api\CLI\Command\OpenStack\User;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:user:update')
            ->setDescription('Update an OpenStack user, limited to description and e-mail.')
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
            ->addArgument(Field::OPENSTACK_USER_EMAIL, InputArgument::OPTIONAL, Field::OPENSTACK_USER_EMAIL__DESC)
            ->addArgument(Field::OPENSTACK_USER_DESCRIPTION, InputArgument::OPTIONAL, Field::OPENSTACK_USER_DESCRIPTION__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId      = $input->getArgument(Field::OPENSTACK_USER_ID);
        $description = $input->getArgument(Field::OPENSTACK_USER_DESCRIPTION);
        $email       = $input->getArgument(Field::OPENSTACK_USER_EMAIL);

        if ($description === null && $email === null) {
            $output->writeln(
                'Nothing to update, please provide either a new user email, a user description or both'
            );
            return 1;
        }

        $user = $this->getTransipApi()->openStackUsers()->getByUserId($userId);

        $user->setEmail($email ?? $user->getEmail());
        $user->setDescription($description ?? $user->getDescription());

        $this->getTransipApi()->openStackUsers()->updateUser($user);
        return 0;
    }
}
