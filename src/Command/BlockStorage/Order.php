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

class Order extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:order')
            ->setDescription('Order a block storage')
            ->addArgument(Field::BLOCKSTORAGE_TYPE, InputArgument::REQUIRED, Field::BLOCKSTORAGE_TYPE__DESC)
            ->addArgument(Field::BLOCKSTORAGE_SIZE, InputArgument::REQUIRED, Field::BLOCKSTORAGE_SIZE__DESC)
            ->addArgument(Field::BLOCKSTORAGE_HASOFFSITEBACKUPS, InputArgument::OPTIONAL, Field::BLOCKSTORAGE_HASOFFSITEBACKUPS__DESC . Field::OPTIONAL)
            ->addArgument(Field::AVAILABILITY_ZONE, InputArgument::OPTIONAL, Field::BLOCKSTORAGE_VPS_AVAILABILITY_ZONE__DESC . Field::OPTIONAL)
            ->addArgument(Field::VPS_NAME, InputArgument::OPTIONAL, Field::BLOCKSTORAGE_VPS_ATTACH__DESC . Field::OPTIONAL)
            ->addArgument(Field::BLOCKSTORAGE_DESCRIPTION, InputArgument::OPTIONAL, FIELD::BLOCKSTORAGE_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->setHelp('This command allows you to order a new block storage');
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageType = $input->getArgument(Field::BLOCKSTORAGE_TYPE);
        $blockStorageSize = $input->getArgument(Field::BLOCKSTORAGE_SIZE);
        $blockStorageHasOffSiteBackups = filter_var($input->getArgument(Field::BLOCKSTORAGE_HASOFFSITEBACKUPS) ?? true, FILTER_VALIDATE_BOOLEAN);
        $blockStorageAvailabilityZone = $input->getArgument(Field::AVAILABILITY_ZONE) ?? '';
        $blockStorageVpsName = $input->getArgument(Field::VPS_NAME) ?? '';
        $blockStorageDescription = $input->getArgument(Field::BLOCKSTORAGE_DESCRIPTION) ?? '';
        $waitForAction = $input->getOption(Field::ACTION_WAIT);

        $response = $this->getTransipApi()->blockStorages()->order(
            $blockStorageType,
            $blockStorageSize,
            $blockStorageHasOffSiteBackups,
            $blockStorageAvailabilityZone,
            $blockStorageVpsName,
            $blockStorageDescription
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

            $actionInput = new ArrayInput($arguments);
            $command->run($actionInput, $output);
        }

        return 0;
    }
}
