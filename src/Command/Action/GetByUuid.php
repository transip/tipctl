<?php

namespace Transip\Api\CLI\Command\Action;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetByUuid extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('action:getbyuuid')
            ->setDescription('Request action information by uuid')
            ->setHelp('This command displays all information about a specific action');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $actionUuid = $input->getArgument(Field::ACTION_UUID);
        $action = $this->getTransipApi()->actions()->getByUuid($actionUuid);
        $this->output($action);
        return 0;
    }
}
