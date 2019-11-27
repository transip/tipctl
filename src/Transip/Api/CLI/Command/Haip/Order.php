<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Order extends AbstractCommand
{
    private const PRODUCT_NAME = 'ProductName';
    private const WAIT_FOR_DELVIERY = 'WaitForDelivery';

    protected function configure(): void
    {
        $this->setName('Haip:order')
            ->setDescription('Order a new Haip')
            ->addArgument(self::PRODUCT_NAME, InputArgument::REQUIRED, 'product name of haip to order')
            ->addArgument(Field::HAIP_DESCRIPTION, InputArgument::OPTIONAL, Field::HAIP_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(self::WAIT_FOR_DELVIERY, 'w', InputOption::VALUE_NONE, 'wait and poll till the Haip is delivered');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productName = $input->getArgument(self::PRODUCT_NAME);
        $description = $input->getArgument(Field::HAIP_DESCRIPTION);

        $shouldWaitForDelivery = $input->getOption(self::WAIT_FOR_DELVIERY);

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
