<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

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
        $this->setName('privatenetwork:order')
            ->setDescription("Order a new private network")
            ->addArgument(Field::PRIVATENETWORK_DESCRIPTION, InputArgument::OPTIONAL, Field::PRIVATENETWORK_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(Field::PRIVATENETWORK_WAIT_FOR_DELIVERY, 'w', InputOption::VALUE_NONE, Field::PRIVATENETWORK_WAIT_FOR_DELIVERY__DESC)
            ->setHelp('After ordering a private network you’re able to attach it to a VPS to make use of the private network.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $description = $input->getArgument(Field::PRIVATENETWORK_DESCRIPTION);
        $shouldWaitForDelivery = $input->getOption(Field::HAIP_WAIT_FOR_DELIVERY);

        if ($description && $shouldWaitForDelivery) {
            $haipsBeforeOrder = $this->getTransipApi()->privateNetworks()->findByDescription($description);
            $this->getTransipApi()->privateNetworks()->order($description);

            while (true) {
                sleep(1);
                $privateNetworks = $this->getTransipApi()->privateNetworks()->findByDescription($description);

                if (count($haipsBeforeOrder) < count($privateNetworks)) {
                    $privateNetwork = end($privateNetworks);
                    $this->output($privateNetwork);
                    return;
                }

                $this->output("Waiting for private network '{$description}', not there yet");
            }
        } else {
            $this->getTransipApi()->privateNetworks()->order();
        }
    }
}
