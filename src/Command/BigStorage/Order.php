<?php


namespace Transip\Api\CLI\Command\BigStorage;

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
        $this->setName('bigstorage:order')
            ->setDescription('Order a big storage')
            ->addArgument(Field::BIGSTORAGE_SIZE, InputArgument::REQUIRED, Field::BIGSTORAGE_SIZE__DESC)
            ->addArgument(Field::BIGSTORAGE_HASOFFSITEBACKUPS, InputArgument::OPTIONAL, Field::BIGSTORAGE_HASOFFSITEBACKUPS__DESC . Field::OPTIONAL)
            ->addArgument(Field::AVAILABILITY_ZONE, InputArgument::OPTIONAL, Field::BIGSTORAGE_VPS_AVAILABILITY_ZONE__DESC . Field::OPTIONAL)
            ->addArgument(Field::VPS_NAME, InputArgument::OPTIONAL, Field::BIGSTORAGE_VPS_ATTACH__DESC . Field::OPTIONAL)
            ->addArgument(Field::BIGSTORAGE_DESCRIPTION, InputArgument::OPTIONAL, FIELD::BIGSTORAGE_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->setHelp('This command allows you to order a new big storage. [deprecated] Use blockstorage:order instead.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:order instead');
        $bigStorageSize               = $input->getArgument(Field::BIGSTORAGE_SIZE);

        // Default must be true
        $bigStorageHasOffSiteBackups  = filter_var($input->getArgument(Field::BIGSTORAGE_HASOFFSITEBACKUPS) ?? true, FILTER_VALIDATE_BOOLEAN);
        $bigStorageAvailabiltyZone    = $input->getArgument(Field::AVAILABILITY_ZONE) ?? '';
        $bigStorageVpsName            = $input->getArgument(Field::VPS_NAME) ?? '';
        $bigStorageDescription        = $input->getArgument(Field::BIGSTORAGE_DESCRIPTION) ?? '';
        $waitForAction                = $input->getOption(Field::ACTION_WAIT);

        $response = $this->getTransipApi()->bigStorages()->order($bigStorageSize, $bigStorageHasOffSiteBackups, $bigStorageAvailabiltyZone, $bigStorageVpsName, $bigStorageDescription);
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
