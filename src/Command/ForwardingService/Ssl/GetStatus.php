<?php

namespace Transip\Api\CLI\Command\ForwardingService\Ssl;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetStatus extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:ssl:getstatus')
            ->setDescription('Get the SSL status of a forwarding service')
            ->setHelp('The SSL status is `pending`, `active` or `disabled`')
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);

        $sslStatus = $this->getTransipApi()->forwardingServiceSsl()->getStatus($domainName);
        $this->output($sslStatus);
        return 0;
    }
}
