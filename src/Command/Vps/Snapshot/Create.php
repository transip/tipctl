<?php

namespace Transip\Api\CLI\Command\Vps\Snapshot;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:snapshot:create')
            ->setDescription('Create a snapshot for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_DESCRIPTION, InputArgument::REQUIRED, Field::VPS_DESCRIPTION__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_SHOULDSTARTVPS, InputArgument::OPTIONAL, Field::VPS_SNAPSHOT_SHOULDSTARTVPS__DESC . Field::OPTIONAL, true)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->addOption(Field::ACTION_PROGRESS, 'p', InputOption::VALUE_NONE, Field::ACTION_PROGRESS_DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $snapshotDescription = $input->getArgument(Field::VPS_SNAPSHOT_DESCRIPTION);
        $shouldStartVps = $input->getArgument(Field::VPS_SNAPSHOT_SHOULDSTARTVPS);
        $shouldStartVps = filter_var($shouldStartVps, FILTER_VALIDATE_BOOLEAN);
        $waitForAction = $input->getOption(Field::ACTION_WAIT);
        $showProgress = $input->getOption(Field::ACTION_PROGRESS);

        $response = $this->getTransipApi()->vpsSnapshots()->createSnapshot($vpsName, $snapshotDescription, $shouldStartVps);
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

            if ($showProgress) {
                $arguments['--showProgress'] = true;
            }
    
            $actionInput = new ArrayInput($arguments);
            $command->run($actionInput, $output);
        }
        return 0;
    }
}
