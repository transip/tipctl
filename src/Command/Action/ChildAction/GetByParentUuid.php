<?php

namespace Transip\Api\CLI\Command\Action\ChildAction;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetByParentUuid extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('action:children:getbyparentuuid')
            ->setDescription('Allows you to list all child actions for a parent action')
            ->addArgument(Field::ACTION_UUID, InputArgument::REQUIRED, Field::ACTION_UUID__DESC)
            ->setHelp('This command displays all child actions for a specific parent action');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $actionUuid = $input->getArgument('parentUuid');
        $actions = $this->getTransipApi()->childActions()->getByParentUuid($actionUuid);
        $this->output($actions);
        return 0;
    }
}
