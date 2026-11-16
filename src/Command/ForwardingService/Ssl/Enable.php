<?php

namespace Transip\Api\CLI\Command\ForwardingService\Ssl;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Enable extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:ssl:enable')
            ->setDescription('Enable SSL for a forwarding service')
            ->setHelp(
                'After enabling SSL the forwarding service can be reached over HTTPS. ' .
                'The SSL status changes when the certificate has been issued.'
            )
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);

        $this->getTransipApi()->forwardingServiceSsl()->enable($domainName);
        return 0;
    }
}
