<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:update')
            ->setDescription('Rename the description of an existing SSH key in your TransIP account')
            ->addArgument(Field::SSH_KEY_ID, InputArgument::REQUIRED, Field::SSH_KEY_ID__DESC)
            ->addArgument(Field::SSH_KEY_DESCRIPTION, InputArgument::REQUIRED, Field::SSH_KEY_DESCRIPTION__DESC)
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sshKeyId = $input->getArgument(Field::SSH_KEY_ID);
        $sshKeyDescription = $input->getArgument(Field::SSH_KEY_DESCRIPTION);

        $this->getTransipApi()->sshKey()->update($sshKeyId, $sshKeyDescription);
    }
}
