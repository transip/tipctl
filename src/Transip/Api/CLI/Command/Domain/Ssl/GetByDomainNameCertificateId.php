<?php

namespace Transip\Api\CLI\Command\Domain\Ssl;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainNameCertificateId extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:Ssl:getByDomainNameCertificateId')
            ->setDescription('Get SSL Certificate by id for a domainName')
            ->setHelp(
                'Provide a id and DomainName to retrieve a specific SSL Certificate'
            )
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::SSL_ID, InputArgument::REQUIRED, Field::SSL_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName      = $input->getArgument(Field::DOMAIN_NAME);
        $certificateId   = $input->getArgument(Field::SSL_ID);
        $sslCertificates = $this->getTransipApi()->domainSsl()->getByDomainNameCertificateId(
            $domainName,
            $certificateId
        );
        $this->output($sslCertificates);
    }
}
