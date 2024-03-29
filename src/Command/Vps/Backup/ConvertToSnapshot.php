<?php


namespace Transip\Api\CLI\Command\Vps\Backup;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertToSnapshot extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:backup:converttosnapshot')
            ->setDescription('Convert a backup to a snapshot.')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_BACKUP_ID, InputArgument::REQUIRED, Field::VPS_BACKUP_ID__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_DESCRIPTION, InputArgument::OPTIONAL, Field::VPS_SNAPSHOT_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->addOption(Field::ACTION_PROGRESS, 'p', InputOption::VALUE_NONE, Field::ACTION_PROGRESS_DESC)
            ->setHelp('Convert a backup to a snapshot for the VPS. Setting a description for a snapshot is highly recommended in case you have multiple snapshots for one VPS.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $backupId = $input->getArgument(Field::VPS_BACKUP_ID);
        $snapshotDescription = $input->getArgument(Field::VPS_SNAPSHOT_DESCRIPTION);
        $waitForAction = $input->getOption(Field::ACTION_WAIT);
        $showProgress = $input->getOption(Field::ACTION_PROGRESS);

        if (!$snapshotDescription) {
            $snapshotDescription = '';
        }

        $response = $this->getTransipApi()->vpsBackups()->convertBackupToSnapshot($vpsName, $backupId, $snapshotDescription);
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
