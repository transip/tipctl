<?php

namespace Transip\Api\CLI\Command\ForwardingService\Ssl;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Disable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:ssl:disable')
            ->setDescription('Disable SSL for a forwarding service')
            ->setHelp('After disabling SSL the forwarding service can only be reached over HTTP.')
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);

        $this->getTransipApi()->forwardingServiceSsl()->disable($domainName);
        return 0;
    }
}
