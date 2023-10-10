<?php

namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetUsage extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('bigstorage:getusage')
            ->setDescription('Get your big storage usage i/o statistics')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::BIGSTORAGE_STARTDATE, InputArgument::OPTIONAL, Field::BIGSTORAGE_STARTDATE__DESC . Field::OPTIONAL, 0)
            ->addArgument(Field::BIGSTORAGE_ENDDATE, InputArgument::OPTIONAL, Field::BIGSTORAGE_ENDDATE__DESC . Field::OPTIONAL, 0)
            ->setHelp('This command allows you to retrieve usage statistics of a big storage. Start and end dates cannot be longer than a one month period. [deprecated] Use blockstorage:getusage instead.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warning('Deprecated: use blockstorage:getusage instead');
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        $dateTimeStart  = $input->getArgument(Field::BIGSTORAGE_STARTDATE);
        $dateTimeEnd    = $input->getArgument(Field::BIGSTORAGE_ENDDATE);

        $response = $this->getTransipApi()->bigStorageUsage()->getUsageStatistics($bigStorageName, $dateTimeStart, $dateTimeEnd);
        $this->output($response);
        return 0;
    }
}
