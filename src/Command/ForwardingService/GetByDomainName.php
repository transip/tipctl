<?php

namespace Transip\Api\CLI\Command\ForwardingService;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('forwardingservice:getbydomainname')
            ->setDescription('Get a forwarding service by domain name')
            ->setHelp('Provide a domain name to retrieve its forwarding service')
            ->addArgument(
                Field::FORWARDING_SERVICE_DOMAIN_NAME,
                InputArgument::REQUIRED,
                Field::FORWARDING_SERVICE_DOMAIN_NAME__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::FORWARDING_SERVICE_DOMAIN_NAME);

        $forwardingService = $this->getTransipApi()->forwardingServices()->getByDomainName($domainName);
        $this->output($forwardingService);
        return 0;
    }
}
