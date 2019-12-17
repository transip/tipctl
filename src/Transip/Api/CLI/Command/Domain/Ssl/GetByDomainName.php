<?php

namespace Transip\Api\CLI\Command\Domain\Ssl;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:ssl:getByDomainName')
            ->setDescription('Get SSL Certificates for a domain')
            ->setHelp(
                'Provide a name to retrieve the SSL Certificates for a specific domain (does not include any letsencrypt certs)'
            )
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $sslCertificates = $this->getTransipApi()->domainSsl()->getByDomainName($domainName);
        $this->output($sslCertificates);
    }
}
