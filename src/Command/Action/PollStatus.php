<?php

namespace Transip\Api\CLI\Command\Action;

use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Action;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PollStatus extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('action:pollstatus')
            ->setDescription('poll the status of an action by uuid')
            ->addArgument(Field::ACTION_UUID, InputArgument::REQUIRED, Field::ACTION_UUID__DESC)
            ->addOption(Field::ACTION_POLL_TIME, 'i', InputOption::VALUE_OPTIONAL, Field::ACTION_POLL_TIME_DESC, 30)
            ->addOption(Field::ACTION_PROGRESS, 'p', InputOption::VALUE_NONE, Field::ACTION_PROGRESS_DESC)
            ->setHelp('This command waits and polls an action until its finished and returns the metadata of the action.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $actionUuid             = $input->getArgument(Field::ACTION_UUID);
        $pollRetryTime          = $input->getOption(Field::ACTION_POLL_TIME);
        $showProgress           = $input->getOption(Field::ACTION_PROGRESS);

        if ($showProgress) {
            return $this->showProgressBar($output, $actionUuid, (int)$pollRetryTime);
        }

        return $this->showMetaData($actionUuid, (int)$pollRetryTime);
    }

    private function showProgressBar(OutputInterface $output, string $actionUuid, int $pollRetryTime): int
    {
        $this->returnActionInfo($actionUuid);

        $progressBar = $this->setupProgressBar($output);
        $progressBar->start();

        while (true) {
            $action = $this->getTransipApi()->actions()->getByUuid($actionUuid);
            if ($action->getStatus() === Action::STATUS_FINISHED) {
                $progressBar->finish();
                return 0;
            }
            $actionProgress = $action->getMetadata();
            $progressBar->setProgress((int)$actionProgress["progress"]);
            sleep($pollRetryTime);
        }
    }

    private function showMetaData(string $actionUuid, int $pollRetryTime): int
    {
        while (true) {
            $action = $this->getTransipApi()->actions()->getByUuid($actionUuid);
            if ($action->getStatus() === Action::STATUS_FINISHED) {
                $this->output($action);
                return 0;
            }
            sleep($pollRetryTime);
        }
    }

    private function setupProgressBar(OutputInterface $output): ProgressBar
    {
        $progressBar = new ProgressBar($output);
        $progressBar->setMaxSteps(100);
        $progressBar->setBarCharacter('<fg=green>█</>');
        $progressBar->setEmptyBarCharacter("<fg=green>▁</>");
        $progressBar->setProgressCharacter('<fg=green>█</>');
        return $progressBar;
    }

    private function returnActionInfo(string $actionUuid): void
    {
        $action      = $this->getTransipApi()->actions()->getByUuid($actionUuid);
        $actionInfo  = sprintf("Polling action %s with uuid %s", $action->getName(), $action->getUuid());

        $this->output($actionInfo);
    }
}
