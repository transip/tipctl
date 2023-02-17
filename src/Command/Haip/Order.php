<?php

namespace Transip\Api\CLI\Command\Haip;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productName           = $input->getArgument(Field::PRODUCT_NAME);
        $description           = $input->getArgument(Field::HAIP_DESCRIPTION) ?? '';
        $shouldWaitForDelivery = $input->getOption(Field::HAIP_WAIT_FOR_DELIVERY);

        $response = $this->getTransipApi()->haip()->order($productName, $description);
        $action = $this->getTransipApi()->actions()->parseActionFromResponse($response);

        if ($action && $shouldWaitForDelivery) {
            $app = $this->getApplication();
            
            if (!$app) {
                return 0;
            }

            $command = $app->get('action:pollstatus');
                
            $arguments = [
                'actionUuid'        => $action->getUuid()
            ];

            $actionInput = new ArrayInput($arguments);
            $command->run($actionInput, $output);
        }
        return 0;
    }
}
