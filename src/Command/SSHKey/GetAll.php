<?php

namespace Transip\Api\CLI\Command\SSHKey;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sshkey:getall')
            ->setDescription('List all SSH keys in your account')
            ->addArgument(Field::PAGE, InputArgument::OPTIONAL, Field::PAGE__DESC . Field::OPTIONAL, 0)
            ->addArgument(Field::ITEMS_PER_PAGE, InputArgument::OPTIONAL, Field::ITEMS_PER_PAGE__DESC . Field::OPTIONAL, 0)
            ->setHelp('This command supports pagination, using this command you can limit the amount of ssh keys returned by the api call, which might be useful if you expect a lot of response objects and you want to spread that over to multiple requests.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $page = $input->getArgument(Field::PAGE);
        $itemsPerPage = $input->getArgument(Field::ITEMS_PER_PAGE);

        $sshKeyList = $this->getTransipApi()->sshKey()->getSelection($page, $itemsPerPage);

        $this->output($sshKeyList);
    }
}
