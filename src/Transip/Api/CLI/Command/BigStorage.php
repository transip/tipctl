<?php

namespace Transip\Api\CLI\Command;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class BigStorage extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('BigStorage')
            ->setDescription('TransIP Bigstorage')
            ->setHelp('Bigstorage for TransIP Vpses')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getBackupsByBigstorageName")
            ->addUsage("cancel")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "cancel":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 2) {
                    throw new Exception("BigstorageName and cancellation time (end|immediately) is required");
                }
                $this->getTransipApi()->bigStorages()->cancel($arguments[0], $arguments[1]);
                break;
            default:
                throw new Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
