<?php

namespace Transip\Api\CLI\Command\BigStorage\Backup;

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
        $this->setName('bigstorage:backup:revert')
            ->setDescription('Restore a bigstorage backup')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::BIGSTORAGE_BACKUPID, InputArgument::REQUIRED, Field::BIGSTORAGE_BACKUPID__DESC)
            ->addArgument(Field::BIGSTORAGE_BACKUP_DESTINATION_NAME, InputArgument::OPTIONAL, Field::BIGSTORAGE_BACKUP_DESTINATION_NAME__DESC . Field::OPTIONAL)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->addOption(Field::ACTION_PROGRESS, 'p', InputOption::VALUE_NONE, Field::ACTION_PROGRESS_DESC)
            ->setHelp('This command restores a big storage backup.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $bigStorageName     = $input->getArgument(Field::BIGSTORAGE_NAME);
        $bigStorageBackupId = $input->getArgument(Field::BIGSTORAGE_BACKUPID);
        $destinationBigStorageName = $input->getArgument(Field::BIGSTORAGE_BACKUP_DESTINATION_NAME) ?? '';
        $waitForAction = $input->getOption(Field::ACTION_WAIT);
        $showProgress = $input->getOption(Field::ACTION_PROGRESS);

        $response = $this->getTransipApi()->bigStorageBackups()->revertBackup(
            $bigStorageName,
            $bigStorageBackupId,
            $destinationBigStorageName
        );
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
