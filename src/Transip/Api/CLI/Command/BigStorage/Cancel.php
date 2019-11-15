<?php


namespace Transip\Api\CLI\Command\BigStorage;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;

class Cancel extends AbstractCommand
{
    const BIGSTORAGE_NAME = 'name';
    const BIGSTORAGE_CANCELTIME = 'cancelTime';

    protected function configure()
    {
        $this->setName('BigStorage:cancel')
            ->setDescription('Terminate or cancel your big storage')
            ->addArgument(self::BIGSTORAGE_NAME, InputArgument::REQUIRED, 'The name of the big storage')
            ->addArgument(self::BIGSTORAGE_CANCELTIME, InputArgument::REQUIRED, 'Cancellation time, either ‘end’ or ‘immediately’')
            ->setHelp('This command will terminate or cancel your big storage.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageName = $input->getArgument(self::BIGSTORAGE_NAME);
        if(strlen($bigStorageName) < 3) {
            throw new Exception('Invalid big storage name provided');
        }

        $bigStorageCancelTime = $input->getArgument(self::BIGSTORAGE_CANCELTIME);
        if(!in_array($bigStorageCancelTime, ['end', 'immediately'])) {
            throw new Exception('Incorrect cancellation time provided, the value can only be `end` or `immediately`.');
        }

        $this->getTransipApi()->bigStorages()->cancel($bigStorageName, $bigStorageCancelTime);
    }
}
