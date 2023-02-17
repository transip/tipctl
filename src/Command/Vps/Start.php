<?php

namespace Transip\Api\CLI\Command\Vps;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Start extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:start')
            ->setDescription('Start a Vps')
            ->setHelp('Provide a Vps name to start')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $waitForAction = $input->getOption(Field::ACTION_WAIT);

        $response = $this->getTransipApi()->vps()->start($vpsName);
        $action = $this->getTransipApi()->actions()->parseActionFromResponse($response);

        if ($action && $waitForAction) {
            $app = $this->getApplication();

            if (!$app) {
                return 0;
            }

            $command = $app->get('action:pollstatus');
                
            $arguments = [
                'actionUuid'        => $action->getUuid()
            ];

            $actionInput = new ArrayInput($arguments);
            $command->run($actionInput, $output);
        }
        return 0;
    }
}
