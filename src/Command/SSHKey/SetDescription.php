<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetDescription extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:setdescription')
            ->setDescription('Set the description of an existing SSH key')
            ->addArgument(Field::SSH_KEY_ID, InputArgument::REQUIRED, Field::SSH_KEY_ID__DESC)
            ->addArgument(Field::SSH_KEY_DESCRIPTION, InputArgument::REQUIRED, Field::SSH_KEY_DESCRIPTION__DESC)
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sshKeyId = $input->getArgument(Field::SSH_KEY_ID);
        $sshKeyDescription = $input->getArgument(Field::SSH_KEY_DESCRIPTION);

        $this->getTransipApi()->sshKey()->update($sshKeyId, $sshKeyDescription);
        return 0;
    }
}
