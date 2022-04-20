<?php

namespace Transip\Api\CLI\Command\OpenStack\User;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetById extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:user:getbyid')
            ->setDescription('Get the openstack user information')
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
            ->setHelp('This API call returns details for an openstack project');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument(Field::OPENSTACK_USER_ID);

        $user = $this->getTransipApi()
            ->openStackUsers()
            ->getByUserId($userId);

        $this->output($user);
        return 0;
    }
}
