<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetUsage extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:getusage')
            ->setDescription('Get your block storage usage i/o statistics')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC)
            ->addArgument(Field::BLOCKSTORAGE_STARTDATE, InputArgument::OPTIONAL, Field::BLOCKSTORAGE_STARTDATE__DESC . Field::OPTIONAL, 0)
            ->addArgument(Field::BLOCKSTORAGE_ENDDATE, InputArgument::OPTIONAL, Field::BLOCKSTORAGE_ENDDATE__DESC . Field::OPTIONAL, 0)
            ->setHelp('This command allows you to retrieve usage statistics of a block storage. Start and end dates cannot be longer than a one month period.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        $dateTimeStart  = $input->getArgument(Field::BLOCKSTORAGE_STARTDATE);
        $dateTimeEnd    = $input->getArgument(Field::BLOCKSTORAGE_ENDDATE);

        $response = $this->getTransipApi()->blockStorageUsage()->getUsageStatistics($blockStorageName, $dateTimeStart, $dateTimeEnd);
        $this->output($response);
        return 0;
    }
}
