<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Order extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('Haip:order')
            ->setDescription('Order a new Haip')
            ->addArgument('productName', InputArgument::REQUIRED, 'product name of haip to order')
            ->addArgument('description', InputArgument::OPTIONAL, 'optional description to give to the Haip')
            ->addOption('waitForDelivery', 'w', InputOption::VALUE_NONE, 'wait and poll till the Haip is delivered');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productName = $input->getArgument('productName');
        $description = $input->getArgument('description');

        $shouldWaitForDelivery = $input->getOption('waitForDelivery');

        if ($description && $shouldWaitForDelivery) {
            $haipsBeforeOrder = $this->getTransipApi()->haip()->findByDescription($description);
            $this->getTransipApi()->haip()->order($productName, $description);

            while (true) {
                sleep(1);
                $haips = $this->getTransipApi()->haip()->findByDescription($description);

                if (count($haipsBeforeOrder) < count($haips)) {
                    $lastHaip = end($haips);
                    return $this->output($lastHaip);
                }

                $this->output("Waiting for haip '{$description}', not there yet");
            }
        } else {
            $this->getTransipApi()->haip()->order($productName, $description);
        }
    }
}