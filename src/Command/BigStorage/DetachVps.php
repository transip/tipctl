<?php


namespace Transip\Api\CLI\Command\BigStorage;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DetachVps extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:detachvps')
            ->setDescription('Detach your big storage to your vps')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->setHelp('This command will detach your big storage from your vps. [deprecated] Use blockstorage:detachvps instead.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:detachvps instead');
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $waitForAction     = $input->getOption(Field::ACTION_WAIT);

        $bigStorage = $this->getTransipApi()->bigStorages()->getByName($bigStorageName);
        $bigStorage->setVpsName('');

        $response = $this->getTransipApi()->bigStorages()->update($bigStorage);
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
