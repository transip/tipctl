<?php

namespace Transip\Api\CLI\Command\OpenStack\User;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Delete extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:user:delete')
            ->setDescription('Delete an OpenStack user.')
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument(Field::OPENSTACK_USER_ID);

        $this->getTransipApi()->openStackUsers()->delete($userId);
        return 0;
    }
}
