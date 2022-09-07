<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\SshKey;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:update')
            ->setDescription('Update a SSH key')
            ->addArgument(Field::SSH_KEY_ID, InputArgument::REQUIRED, Field::SSH_KEY_ID__DESC)
            ->addArgument(Field::SSH_KEY_DESCRIPTION, InputArgument::REQUIRED, Field::SSH_KEY_DESCRIPTION__DESC)
            ->addArgument(Field::SSH_KEY_IS_DEFAULT, InputArgument::REQUIRED, Field::SSH_KEY_IS_DEFAULT_DESC)
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sshKey = $input->getArgument(Field::SSH_KEY);
        $sshKeyDescription = $input->getArgument(Field::SSH_KEY_DESCRIPTION);
        $sshKeyIsDefault = filter_var($input->getArgument(Field::SSH_KEY_IS_DEFAULT), FILTER_VALIDATE_BOOL);

        $sshKeyObject = new SshKey();
        $sshKeyObject->setId($sshKey);
        $sshKeyObject->setDescription($sshKeyDescription);
        $sshKeyObject->setIsDefault($sshKeyIsDefault);

        $this->getTransipApi()->sshKey()->updateKey($sshKeyObject);
        return 0;
    }
}
