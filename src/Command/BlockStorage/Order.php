<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Exception\ExceptionInterface;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Order extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:order')
            ->setDescription('Order a block storage')
            ->addOption(Field::BLOCKSTORAGE_TYPE, 'y', InputOption::VALUE_REQUIRED, Field::BLOCKSTORAGE_TYPE__DESC)
            ->addOption(Field::BLOCKSTORAGE_SIZE, 's', InputOption::VALUE_REQUIRED, Field::BLOCKSTORAGE_SIZE__DESC)
            ->addOption(Field::BLOCKSTORAGE_HASOFFSITEBACKUPS, 'b', InputOption::VALUE_OPTIONAL, Field::BLOCKSTORAGE_HASOFFSITEBACKUPS__DESC . Field::OPTIONAL)
            ->addOption(Field::AVAILABILITY_ZONE, 'z', InputOption::VALUE_OPTIONAL, Field::BLOCKSTORAGE_VPS_AVAILABILITY_ZONE__DESC . Field::OPTIONAL)
            ->addOption(Field::VPS_NAME, 'a', InputOption::VALUE_OPTIONAL, Field::BLOCKSTORAGE_VPS_ATTACH__DESC . Field::OPTIONAL)
            ->addOption(Field::BLOCKSTORAGE_DESCRIPTION, 'e', InputOption::VALUE_OPTIONAL, FIELD::BLOCKSTORAGE_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->setHelp('This command allows you to order a new block storage');
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageType = $input->getOption(Field::BLOCKSTORAGE_TYPE);
        $blockStorageSize = $input->getOption(Field::BLOCKSTORAGE_SIZE);
        $blockStorageHasOffSiteBackups = filter_var($input->getOption(Field::BLOCKSTORAGE_HASOFFSITEBACKUPS) ?? true, FILTER_VALIDATE_BOOLEAN);
        $blockStorageAvailabilityZone = $input->getOption(Field::AVAILABILITY_ZONE) ?? '';
        $blockStorageVpsName = $input->getOption(Field::VPS_NAME) ?? '';
        $blockStorageDescription = $input->getOption(Field::BLOCKSTORAGE_DESCRIPTION) ?? '';
        $waitForAction = $input->getOption(Field::ACTION_WAIT);

        if ($blockStorageType === null) {
            $output->writeln("BlockStorageType is required");
            return 0;
        }

        if ($blockStorageSize === null) {
            $output->writeln("BlockStorageSize is required");
            return 0;
        }

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
