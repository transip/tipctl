<?php


namespace Transip\Api\CLI\Command\BigStorage;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;
use Transip\Api\CLI\Command\Field;

class Cancel extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('BigStorage:cancel')
            ->setDescription('Terminate or cancel your big storage')
            ->addArgument(Field::BIGSTORAGE_NAME, InputArgument::REQUIRED, Field::BIGSTORAGE_NAME__DESC)
            ->addArgument(Field::CANCELTIME, InputArgument::REQUIRED, Field::CANCELTIME__DESC)
            ->setHelp('This command will terminate or cancel your big storage.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(Field::BIGSTORAGE_NAME);
        if (strlen($bigStorageName) < 3) {
            throw new Exception('Invalid big storage name provided');
        }

        $bigStorageCancelTime = $input->getArgument(Field::CANCELTIME);
        if (!in_array($bigStorageCancelTime, ['end', 'immediately'])) {
            throw new Exception("Incorrect cancellation time provided, the value can only be 'end' or 'immediately'.");
        }

        $this->getTransipApi()->bigStorages()->cancel($bigStorageName, $bigStorageCancelTime);
    }
}
