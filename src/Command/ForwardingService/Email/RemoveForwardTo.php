<?php

namespace Transip\Api\CLI\Command\ForwardingService\Email;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class RemoveForwardTo extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:email:removeforwardto')
            ->setDescription('Stop forwarding email for a forwarding service')
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);

        $this->getTransipApi()->forwardingServiceEmail()->removeForwardTo($domainName);
        return 0;
    }
}
