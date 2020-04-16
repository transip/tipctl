<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:getall')
            ->setDescription('List all SSH keys in your TransIP account')
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sshKeyList = $this->getTransipApi()->sshKey()->getAll();

        $this->output($sshKeyList);
    }
}
