<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

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
        $this->setName('privatenetwork:order')
            ->setDescription("Order a new private network")
            ->addArgument(Field::PRIVATENETWORK_DESCRIPTION, InputArgument::OPTIONAL, Field::PRIVATENETWORK_DESCRIPTION__DESC . Field::OPTIONAL)
            ->addOption(Field::PRIVATENETWORK_WAIT_FOR_DELIVERY, 'w', InputOption::VALUE_NONE, Field::PRIVATENETWORK_WAIT_FOR_DELIVERY__DESC)
            ->setHelp('After ordering a private network you’re able to attach it to a VPS to make use of the private network.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $description = $input->getArgument(Field::PRIVATENETWORK_DESCRIPTION) ?? '';
        $shouldWaitForDelivery = $input->getOption(Field::HAIP_WAIT_FOR_DELIVERY);

        $response = $this->getTransipApi()->privateNetworks()->order($description);
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
