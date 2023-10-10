<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Exception\ExceptionInterface;
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
        $this->setName('blockstorage:detachvps')
            ->setDescription('Detach your block storage to your vps')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->setHelp('This command will detach your block storage from your vps.');
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        $waitForAction     = $input->getOption(Field::ACTION_WAIT);

        $blockStorage = $this->getTransipApi()->blockStorages()->getByName($blockStorageName);
        $blockStorage->setVpsName('');

        $response = $this->getTransipApi()->blockStorages()->update($blockStorage);
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

            $actionInput = new ArrayInput($arguments);
            $command->run($actionInput, $output);
        }

        return 0;
    }
}
