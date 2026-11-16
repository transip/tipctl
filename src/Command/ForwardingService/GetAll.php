<?php

namespace Transip\Api\CLI\Command\ForwardingService;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:getall')
            ->setDescription('Get all of your forwarding services');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $forwardingServices = $this->getTransipApi()->forwardingServices()->getAll();
        $this->output($forwardingServices);
        return 0;
    }
}
