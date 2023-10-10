<?php

namespace Transip\Api\CLI\Command\BlockStorage\Backup;

use Symfony\Component\Console\Exception\ExceptionInterface;
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
        $this->setName('blockstorage:backup:revert')
            ->setDescription('Restore a blockstorage backup')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC)
            ->addArgument(Field::BLOCKSTORAGE_BACKUPID, InputArgument::REQUIRED, Field::BLOCKSTORAGE_BACKUPID__DESC)
            ->addArgument(Field::BLOCKSTORAGE_BACKUP_DESTINATION_NAME, InputArgument::OPTIONAL, Field::BLOCKSTORAGE_BACKUP_DESTINATION_NAME__DESC . Field::OPTIONAL)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->addOption(Field::ACTION_PROGRESS, 'p', InputOption::VALUE_NONE, Field::ACTION_PROGRESS_DESC)
            ->setHelp('This command restores a block storage backup.');
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName     = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        $blockStorageBackupId = $input->getArgument(Field::BLOCKSTORAGE_BACKUPID);
        $destinationBlockStorageName = $input->getArgument(Field::BLOCKSTORAGE_BACKUP_DESTINATION_NAME) ?? '';
        $waitForAction = $input->getOption(Field::ACTION_WAIT);
        $showProgress = $input->getOption(Field::ACTION_PROGRESS);

        $response = $this->getTransipApi()->blockStorageBackups()->revertBackup(
            $blockStorageName,
            $blockStorageBackupId,
            $destinationBlockStorageName
        );

        $action = $this->getTransipApi()->actions()->parseActionFromResponse($response);

        if ($action && $waitForAction) {
            $app = $this->getApplication();
            if (!$app) {
                return 0;
            }

            $command = $app->get('action:pollstatus');

            $arguments = [
                'actionUuid' => $action->getUuid()
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
