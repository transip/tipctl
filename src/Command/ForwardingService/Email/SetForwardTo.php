<?php

namespace Transip\Api\CLI\Command\ForwardingService\Email;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetForwardTo extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:email:setforwardto')
            ->setDescription('Forward email for a forwarding service to an email address')
            ->setHelp('Email for the domain name of the forwarding service is forwarded to the given email address')
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            )
            ->addArgument(
                Field::FORWARDING_SERVICE_EMAIL_FORWARD_TO,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_EMAIL_FORWARD_TO__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);
        $forwardTo = $input->getArgument(Field::FORWARDING_SERVICE_EMAIL_FORWARD_TO);

        $this->getTransipApi()->forwardingServiceEmail()->setForwardTo($domainName, $forwardTo);
        return 0;
    }
}
