<?php

namespace Transip\Api\CLI\Command\OpenStack\User\Tokens;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAllS3Tokens extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:users:token:getbyuserid')
            ->setDescription('Get all tokens for an openstack user')
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
            ->setHelp('This API call returns details for all S3 tokens or filtered on a specific project');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument(Field::OPENSTACK_USER_ID);

        $usersData = $this->getTransipApi()
            ->openStackTokens()
            ->getAllByUserId($userId);

        $this->output($usersData);
        return 0;
    }
}
