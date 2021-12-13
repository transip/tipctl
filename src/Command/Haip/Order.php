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
    protected function configure(): void
    {
        $this->setName('haip:order')
            ->setDescription('Order a new HA-IP')
            ->addArgument(Field::PRODUCT_NAME, InputArgument::REQUIRED, Field::PRODUCT_NAME__DESC)
            ->addArgument(Field::HAIP_DESCRIPTION, InputArgument::OPTIONAL, Field::HAIP_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(Field::HAIP_WAIT_FOR_DELIVERY, 'w', InputOption::VALUE_NONE, Field::HAIP_WAIT_FOR_DELIVERY__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productName           = $input->getArgument(Field::PRODUCT_NAME);
        $description           = $input->getArgument(Field::HAIP_DESCRIPTION);
        $shouldWaitForDelivery = $input->getOption(Field::HAIP_WAIT_FOR_DELIVERY);

        if ($description && $shouldWaitForDelivery) {
            $haipsBeforeOrder = $this->getTransipApi()->haip()->findByDescription($description);
            $this->getTransipApi()->haip()->order($productName, $description);

            while (true) {
                sleep(1);
                $haips = $this->getTransipApi()->haip()->findByDescription($description);

                if (count($haipsBeforeOrder) < count($haips)) {
                    $lastHaip = end($haips);
                    $this->output($lastHaip);
                    return;
                }

                $this->output("Waiting for haip '{$description}', not there yet");
            }
        } else {
            $this->getTransipApi()->haip()->order($productName, $description);
        }
    }
}
