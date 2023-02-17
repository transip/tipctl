<?php

namespace Transip\Api\CLI\Command\Vps\Backup;

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
        $this->setName('vps:backup:revert')
            ->setDescription('Revert a VPS back-up and restore the VPS to an earlier state')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_BACKUP_ID, InputArgument::REQUIRED, Field::VPS_BACKUP_ID__DESC)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->addOption(Field::ACTION_PROGRESS, 'p', InputOption::VALUE_NONE, Field::ACTION_PROGRESS_DESC)
            ->setHelp('Reverting a VPS back-up will restore the VPS to an earlier state. Use this API call with care, as data created after the back-up creation date can be wiped when a back-up is restored.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $backupId = $input->getArgument(Field::VPS_BACKUP_ID);
        $waitForAction = $input->getOption(Field::ACTION_WAIT);
        $showProgress = $input->getOption(Field::ACTION_PROGRESS);

        $response = $this->getTransipApi()->vpsBackups()->revertBackup($vpsName, $backupId);
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
