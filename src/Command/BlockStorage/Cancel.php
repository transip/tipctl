<?php

namespace Transip\Api\CLI\Command\BlockStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;
use Transip\Api\CLI\Command\Field;

class Cancel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('blockstorage:cancel')
            ->setDescription('Terminate or cancel your block storage')
            ->addArgument(Field::BLOCKSTORAGE_NAME, InputArgument::REQUIRED, Field::BLOCKSTORAGE_NAME__DESC)
            ->addArgument(Field::CANCELTIME, InputArgument::REQUIRED, Field::CANCELTIME__DESC)
            ->setHelp('This command will terminate or cancel your block storage.');
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $blockStorageName = $input->getArgument(Field::BLOCKSTORAGE_NAME);
        if (strlen($blockStorageName) < 3) {
            throw new Exception('Invalid block storage name provided');
        }

        $blockStorageCancelTime = $input->getArgument(Field::CANCELTIME);
        if (!in_array($blockStorageCancelTime, ['end', 'immediately'])) {
            throw new Exception("Incorrect cancellation time provided, the value can only be 'end' or 'immediately'.");
        }

        $this->getTransipApi()->blockStorages()->cancel($blockStorageName, $blockStorageCancelTime);
        return 0;
    }
}
