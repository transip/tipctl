<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Add extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:add')
            ->setDescription('Add a new SSH key')
            ->addArgument(Field::SSH_KEY, InputArgument::REQUIRED, Field::SSH_KEY__DESC)
            ->addArgument(Field::SSH_KEY_DESCRIPTION, InputArgument::OPTIONAL, Field::SSH_KEY_DESCRIPTION__DESC, '')
            ->addArgument(Field::SSH_KEY_IS_DEFAULT, InputArgument::OPTIONAL, Field::SSH_KEY_IS_DEFAULT_DESC, false)
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sshKey = $input->getArgument(Field::SSH_KEY);
        $sshKeyDescription = $input->getArgument(Field::SSH_KEY_DESCRIPTION);
        $sshKeyIsDefault = $input->getArgument(Field::SSH_KEY_IS_DEFAULT);

        $this->getTransipApi()->sshKey()->create($sshKey, $sshKeyDescription, $sshKeyIsDefault);
        return 0;
    }
}
