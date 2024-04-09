<?php

namespace Transip\Api\CLI\Command\OpenStack\User\Tokens;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Delete extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('openstack:users:token:delete')
            ->setDescription('Delete a specific S3 token')
            ->addArgument(Field::OPENSTACK_USER_ID, InputArgument::REQUIRED, Field::OPENSTACK_USER_ID__DESC)
            ->addArgument(Field::OPENSTACK_TOKEN_ID, InputArgument::REQUIRED, Field::OPENSTACK_TOKEN_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tokenId = $input->getArgument(Field::OPENSTACK_TOKEN_ID);
        $userId  = $input->getArgument(Field::OPENSTACK_USER_ID);

        $this->getTransipApi()
            ->openStackTokens()
            ->delete($userId, $tokenId);
        return 0;
    }
}
