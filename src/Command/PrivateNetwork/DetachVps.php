<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DetachVps extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('privatenetwork:detachvps')
            ->setDescription('Remove a VPS from a private network')
            ->addArgument(Field::PRIVATENETWORK_NAME, InputArgument::REQUIRED, Field::PRIVATENETWORK_NAME__DESC)
            ->addOption(Field::ACTION_WAIT, 'p', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $privateNetworkName = $input->getArgument(Field::PRIVATENETWORK_NAME);
        $vpsName            = $input->getArgument(Field::VPS_NAME);
        $waitForAction = $input->getOption(Field::ACTION_WAIT);

        $response = $this->getTransipApi()->privateNetworks()->detachVps($privateNetworkName, $vpsName);
        $action = $this->getTransipApi()->actions()->parseActionFromResponse($response);

        if ($action && $waitForAction) {
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
