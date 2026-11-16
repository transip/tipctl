<?php

namespace Transip\Api\CLI\Command\ForwardingService\Email;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetForwardTo extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:email:getforwardto')
            ->setDescription('Get the email address that the service forwards to')
            ->setHelp('The output is empty when email is not forwarded')
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);

        $forwardTo = $this->getTransipApi()->forwardingServiceEmail()->getForwardTo($domainName);
        $this->output($forwardTo ?? '');
        return 0;
    }
}
