<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetById extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:getbyid')
            ->setDescription('Request information about an existing SSH key from your TransIP account')
            ->addArgument(Field::SSH_KEY_ID, InputArgument::REQUIRED, Field::SSH_KEY_ID)
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sshKeyId = $input->getArgument(Field::SSH_KEY_ID);

        $sshKey = $this->getTransipApi()->sshKey()->getById($sshKeyId);

        $this->output($sshKey);
    }
}
