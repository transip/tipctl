<?php

namespace Transip\Api\CLI\Command\Vps\Snapshot;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Revert extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:snapshot:revert')
            ->setDescription('Revert a snapshot to a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_NAME, InputArgument::REQUIRED, Field::VPS_SNAPSHOT_NAME__DESC)
            ->addArgument(Field::VPS_DESTINATION_VPS_NAME, InputArgument::OPTIONAL, Field::VPS_DESTINATION_VPS_NAME__DESC . Field::OPTIONAL)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->addOption(Field::ACTION_PROGRESS, 'p', InputOption::VALUE_NONE, Field::ACTION_PROGRESS_DESC)
            ->setHelp('When restoring a snapshot, this can be done either on the VPS the snapshot originates from or onto another VPS. Specifying the DestinationVpsName makes sure the snapshot is restored onto another VPS');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $snapshotName = $input->getArgument(Field::VPS_SNAPSHOT_NAME);
        $destinationVpsName = $input->getArgument(Field::VPS_DESTINATION_VPS_NAME) ?? '';
        $waitForAction = $input->getOption(Field::ACTION_WAIT);
        $showProgress = $input->getOption(Field::ACTION_PROGRESS);

        $response = $this->getTransipApi()->vpsSnapshots()->revertSnapshot($vpsName, $snapshotName, $destinationVpsName);
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
