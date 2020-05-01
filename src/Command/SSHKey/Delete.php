<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Delete extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:delete')
            ->setDescription('Delete an existing SSH key')
            ->addArgument(Field::SSH_KEY_ID, InputArgument::REQUIRED, Field::SSH_KEY_ID__DESC)
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sshKeyId = $input->getArgument(Field::SSH_KEY_ID);

        $this->getTransipApi()->sshKey()->delete($sshKeyId);
    }
}
