<?php


namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

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
            ->setHelp('This command allows you to order a new big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $bigStorageSize               = $input->getArgument(Field::BIGSTORAGE_SIZE);

        // Default must be true
        $bigStorageHasOffSiteBackups  = filter_var($input->getArgument(Field::BIGSTORAGE_HASOFFSITEBACKUPS) ?? true, FILTER_VALIDATE_BOOLEAN);
        $bigStorageAvailabiltyZone    = $input->getArgument(Field::AVAILABILITY_ZONE) ?? '';
        $bigStorageVpsName            = $input->getArgument(Field::VPS_NAME) ?? '';
        $bigStorageDescription        = $input->getArgument(Field::BIGSTORAGE_DESCRIPTION) ?? '';

        $this->getTransipApi()->bigStorages()->order($bigStorageSize, $bigStorageHasOffSiteBackups, $bigStorageAvailabiltyZone, $bigStorageVpsName, $bigStorageDescription);
        return 0;
    }
}
